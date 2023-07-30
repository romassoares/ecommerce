<?php

namespace App\Repository;

use App\Models\Compra;
use App\Models\itensCompra;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompraRepository
{
    private $compra;
    private $itens;

    public function __construct(Compra $compra, itensCompra $itens)
    {
        $this->compra = $compra;
        $this->itens = $itens;
    }

    public function createCompra()
    {
        $result = $this->compra->create([
            'user_id' => Auth::id(),
            'status' => 'aberta'
        ]);

        return $result;
    }

    public function addItem($product, $compra)
    {
        $result = $this->itens->create([
            'user_id' => $compra->user_id,
            'product_id' => $product,
            'compra_id' => $compra->id
        ]);
        if ($result) {

            return $result;
        }
    }

    public function findProduct($product_id)
    {
        return $this->itens->where('product_id', $product_id)->first();
    }

    public function if_compra_aberta()
    {
        return $this->compra
            ->where('user_id', Auth::id())
            ->where('status', 'aberta')
            ->first();
    }

    public function itens()
    {
        $compra = Compra::where('user_id', Auth::user()->id)
            ->where('status', 'aberta')
            ->first();

        return $compra ? $compra->products : [];
    }

    public function valorItensCarrinho($user_id)
    {
        $result = DB::table('itens_compra')
            ->join('products', 'itens_compra.product_id', 'products.id')
            ->join('compras', 'itens_compra.compra_id', 'compras.id')
            ->selectRaw('SUM(products.preco) as total')
            ->where('compras.user_id', $user_id)
            ->where('compras.status', '=', 'aberta')
            ->first();
        return $result->total;
    }

    public function finalizarCompra($valor, $user_id)
    {
        $compra = $this->if_compra_aberta();

        $compra->status = 'finalizada';
        $compra->preco = $valor;
        $compra->save();

        return $compra;
    }
}
