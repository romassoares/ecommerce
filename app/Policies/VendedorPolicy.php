<?php

namespace App\Policies;

use App\Models\Vendedor;
use Illuminate\Auth\Access\HandlesAuthorization;

class VendedorPolicy
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

    public function block_if_pending_or_rejected($user)
    {
        return $user->vendedor->status === 'pen' || $user->vendedor->status === 'rej';
    }
}
