<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use SocialiteProviders\Manager\OAuth2\User as OAuthUser;

class UserRepository
{
    /**
     * @param $user
     * @param $social
     * @return Builder|User
     */
    public function firstOrCreateUser($user, $social): Builder|User
    {
        $userInSystem = User::query()
            ->where('social_id', $user->id)
            ->where('social_type', $social)
            ->first();

        if (is_null($userInSystem)) {
            $userInSystem = new User();

            $userInSystem->fill([
                'name' => $user->getName() ?? $user->getNickname() ?? '',
                'email' => $user->getEmail() ?? '',
                'password' => Hash::make('123'),
                'social_id' => $user->getId() ?? 'site',
                'social_type' => $social,
                'email_verified_at' => now(),
                'avatar' => $user->getAvatar()
            ]);

            $userInSystem->save();
        }

        return $userInSystem;
    }
}
