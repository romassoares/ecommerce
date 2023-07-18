<?php

namespace App\Repository;

use App\Models\Compra;
use App\Models\itensCompra;
use Illuminate\Support\Facades\Auth;

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
        return $result;
    }

    public function findProduct($product_id)
    {
        $result = $this->itens
            ->where('product_id', $product_id)->first();
        return $result;
    }

    public function if_compra_aberta()
    {
        $result = $this->compra
            ->where('user_id', Auth::id())
            ->where('status', 'aberta')
            ->first();

        return $result;
    }

    public function itens()
    {
        dd('sdf');
        $compra = $this->compra
            ->where('user_id', Auth::id())
            ->where('status', 'aberta')->first();
        dd($compra);
        if (isset($compra)) {
            $itens = $this->itens->where('compra_id', $compra->id)->get();

            return $itens;
        } else {
            return $itens = [];
        }
    }

    public function valorItensCarrinho()
    {
        $result = $this->itens
            ->join('products', 'itens_compra.product_id', 'products.id')
            ->selectRaw('SUM(products.preco) as total')
            ->get();

        return $result->first()->total;
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
