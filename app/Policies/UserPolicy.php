<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function view_products(User $user)
    {
        return isset($user->vendedor->status) && $user->vendedor->status === 'apr' || $user->type === 'com' || $user->type === 'adm';
    }

    public function if_user_admin(User $user)
    {
        return $user->type === 'adm';
    }

    public function user_com(User $user)
    {
        return $user->type === 'com';
    }

    public function user_ven(User $user)
    {
        return $user->type === 'ven';
    }
}
