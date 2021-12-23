<?php
/** @noinspection PhpPossiblePolymorphicInvocationInspection */

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use JetBrains\PhpStorm\ArrayShape;

class ProfileController extends Controller
{
    /**
     * @param int $id
     * @return Renderable
     */
    public function editPassword(int $id): Renderable
    {
        if (auth()->user()->getAttribute('is_admin')) {
            return view('profile.password', ['user' => User::query()->find($id)]);
        }
        return view('profile.password', ['user' => auth()->user()]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function updatePassword(Request $request, User $user): RedirectResponse
    {
        if (
            auth()->user()->getAttribute('is_admin') || isset($request['currentPassword'])
            && Hash::check($request['currentPassword'], $user->getAuthPassword())
        ) {

            $data = $this->validate($request, $this->passwordRules());
            $user->setAttribute('password', Hash::make($data['password']));
            $user->save();
            return redirect()
                ->route('profile.password.edit', $user->getAttribute('id'))
                ->with(['type' => 'success', 'message' => 'Пароль успешно изменён!']);
        }
        return redirect()
            ->route('profile.password.edit', $user->getAttribute('id'))
            ->withErrors(['currentPassword' => 'Неверный пароль.']);
    }

    /**
     * Displaying profiles where common users and admins can change information.
     * @param int $id
     * @return Renderable
     */
    public function editProfile(int $id): Renderable
    {
        if (auth()->user()->getAttribute('is_admin')) {
            return view('profile.show', ['user' => User::query()->find($id)]);
        }
        return view('profile.show', ['user' => auth()->user()]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function updateProfile(Request $request, User $user): RedirectResponse
    {
        $data = $this->validate($request, $this->profileRules($user));
        $user->fill($data);

        if (auth()->user()->getAttribute('is_admin')) {
            $user->setAttribute('is_admin', !!$data['is_admin']);
        }

        $user->save();
        return redirect()
            ->route('profile.edit', $user->getAttribute('id'))
            ->with(['type' => 'success', 'message' => 'Профиль изменён!']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape([
        'password' => "string",
        'password_confirmation' => "string"
    ])]
    public function passwordRules(): array
    {
        return [
            'password' => 'required|confirmed|string|min:3',
            'password_confirmation' => 'required|string|min:3'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param $user
     * @return array
     */
    #[ArrayShape([
        'name' => "string",
        'email' => "string",
        'is_admin' => "string"
    ])]
    public function profileRules($user): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'is_admin' => 'string'
        ];
    }
}
