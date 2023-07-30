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
        // dd($valorItens);
        $user_vendedor = DB::table('ven_perfils as vp')
            ->select('vp.*')
            ->join('products as p', 'vp.user_id', 'p.user_id')
            ->join('itens_compra as ic', 'p.id', 'ic.product_id')
            ->join('compras as c', 'ic.user_id', 'c.user_id')
            ->where('c.user_id', $user)
            ->where('c.status', 'aberta')
            ->where('vp.status', 'apr')
            ->first();
        $vendedor = Vendedor::where('id', $user_vendedor->id)->update([
            'credit' => $user_vendedor->credit + $valorItens
        ]);

        $comprador = Comprador::where('user_id', Auth::id())->update(['credit' => DB::raw("com_perfils.credit - $valorItens")]);
        // dd($comprador);

        if ($comprador && $vendedor)
            return;
    }
}
