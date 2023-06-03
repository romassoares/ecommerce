<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function view_products(User $user)
    {
        return $user->vendedor->status === 'apr' || $user->type === 'com' || $user->type === 'adm';
    }
}
