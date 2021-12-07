<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use JetBrains\PhpStorm\ArrayShape;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param User $users
     * @return Renderable
     */
    public function index(User $users): Renderable
    {
        return view('admin.users.index')
            ->with('users',
                $users->query()
                    ->whereNotIn('id', ['id' => Auth::user()->id])
                    ->paginate(9));
    }

    /**
     * Displaying profiles where common users can change information themselves.
     *
     * @param int $id
     * @return Renderable|RedirectResponse
     */
    public function edit(int $id): Renderable|RedirectResponse
    {
        $authUser = Auth::user();

        if ($authUser->is_admin) {
            return view('profile.showProfile', ['user' => User::query()->find($id)]);
        }

        if ($id == $authUser->id) {
            return view('profile.showProfile' , ['user' => $authUser]);
        }

        return redirect()->route('news.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $currentPassword = $request->get('currentPassword');

        if (auth()->user()->getAttributeValue('is_admin') || Hash::check($currentPassword, $user->password)) {

            $data = $this->validate($request, $this->rules($user), [], $this->attributes());
            $user->fill($data);
            $user->setAttribute('password', Hash::make($user->getAttributeValue('password')));
            if ($request->user()->is_admin ?? auth()->user()->is_admin) {
                $user->setAttribute('is_admin', 1);
            }
            $user->save();
            return redirect()->route('showProfile', $user->id)->with(['type' => 'success', 'message' => 'Изменения сохранены!']);
        }

        return redirect()->route('showProfile', $user)->withErrors(['currentPassword' => 'Неверно введён текущий пароль!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()
            ->route('admin.users.index')
            ->with(['type' => 'success', 'message' => 'Пользователь удалён!']);
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
        'password' => "string",
        'password_confirmation' => "string"
    ])]
    public function rules($user): array
    {
        return [
            'name' => 'required|string|max:30',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required|confirmed|min:3',
            'password_confirmation' => 'required|string|min:3'
        ];
    }

    /**
     * Get the custom validation attributes that apply the request.
     * @return array
     */
    #[ArrayShape(['currentPassword' => "string"])]
    public function attributes(): array
    {
        return [
            'currentPassword' => 'Текущий пароль'
        ];
    }
}
