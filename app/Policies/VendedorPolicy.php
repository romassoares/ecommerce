<?php

namespace App\Policies;

use App\Models\Vendedor;
use Illuminate\Auth\Access\HandlesAuthorization;

class VendedorPolicy
{
    use HandlesAuthorization;

    public function block_if_pending_or_rejected($user)
    {
        if ($user->type == 'ven')
            return $user->vendedor->status === 'pen' || $user->vendedor->status === 'rej';
    }
}
