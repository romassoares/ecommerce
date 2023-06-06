<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Comprador;
use App\Models\Product;
use App\Models\Vendedor;
use App\Repository\CompraRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    private $compraRepository;

    public function __construct(CompraRepository $compraRepository)
    {
        $this->compraRepository = $compraRepository;
    }

    public function index()
    {
        $categorias = DB::table('products')->select('categoria')->distinct()->get();
        $compras = Compra::paginate(10);
        return view('compra.index', ['compras' => $compras, 'categorias' => $categorias]);
    }

    public function search(Request $request)
    {
        $query = Product::query();

        if (isset($request->name)) {
            $query->where('nome', 'LIKE', '%' . $request->name . '%');
        }

        if (isset($request->categoria)) {
            $query->where('categoria', $request->categoria);
        }

        if (isset($request->preco)) {
            $query->orderBy('preco', $request->preco == 'men' ? 'asc' : 'desc');
        }

        $products = $query->where('user_id', Auth::id())->paginate(10);
        $categorias = DB::table('products')->select('categoria')->distinct()->get();
        return view("product.index", ['products' => $products, 'categorias' => $categorias]);
    }

    public function addItem($product_id)
    {
        $if_compra_aberta = $this->compraRepository->if_compra_aberta();

        if (isset($if_compra_aberta)) {

            $this->compraRepository->addItem($product_id, $if_compra_aberta);
            return redirect()->back();
        } else {
            $response = $this->compraRepository->createCompra();

            $this->compraRepository->addItem($product_id, $response);
            return redirect()->back();
        }
    }

    public function carrinho()
    {
        $itens = $this->compraRepository->itens();
        return view('compra.carrinho', ['itens' => $itens]);
    }

    public function finalizar($user_id)
    {
        $valorItens = $this->compraRepository->valorItensCarrinho();

        $vendedor = Vendedor::insert([
            'user_id' => $user_id,
            'credit' => $valorItens
        ]);

        $comprador = Comprador::where('user_id', $user_id)->first();
        $comprador->credit -= $valorItens;

        $comprador->save();

        $compra = $this->compraRepository->finalizarCompra($valorItens, $user_id);

        return redirect()->back();
    }
}
