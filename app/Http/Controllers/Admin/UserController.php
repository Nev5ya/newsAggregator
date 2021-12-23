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
                    ->whereNotIn('id', ['id' => auth()->user()->getAuthIdentifier()])
                    ->paginate(9));
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
}
