<?php

namespace App\Repository;

use App\Models\Compra;
use App\Models\Comprador;
use App\Models\itensCompra;
use App\Models\Vendedor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PerfilRepository
{
    public function addCreditToCom($data)
    {
        $result = DB::table('com_perfils')->insert([
            'user_id' => $data->id,
            'credit' => '10000.00'
        ]);
        return $result ? true : false;
    }

    public function setStatusToPendingAndAddProducts($user)
    {
        $result = DB::table("ven_perfils")->insert([
            'user_id' => $user->id,
            'status' => "pen"
        ]);

        return $result ? true : false;
    }

    public function if_exist_credit($user)
    {
        $result = DB::table('com_perfils')
            ->select('com_perfils.credit')
            ->join('users', 'com_perfils.user_id', 'users.id')
            ->first();
        return ($result->credit > 0) ? $result : false;
    }

    public function updateCreditVendedorEComprador($user, $valorItens)
    {
        $id_user_vendedor = Compra::where('user_id', $user)->first();
        $vendedor = Vendedor::find($id_user_vendedor)->first();
        $vendedor->credit += $valorItens;

        $comprador = Comprador::where('user_id', Auth::id())->first();
        $comprador->credit -= $valorItens;

        if ($comprador->save() && $vendedor->update())
            return;
    }
}
