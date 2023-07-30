<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Product;
use App\Repository\CompraRepository;
use App\Repository\PerfilRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    private $compraRepository;
    private $perfilRepository;

    public function __construct(CompraRepository $compraRepository, PerfilRepository $perfilRepository)
    {
        $this->compraRepository = $compraRepository;
        $this->perfilRepository = $perfilRepository;
    }

    public function index()
    {
        $categorias = DB::table('products')->select('categoria')->distinct()->get();

        if (Auth::user()->type === 'adm') {

            $compras = Compra::paginate(10);
        } elseif (Auth::user()->type === 'ven') {

            $compras = DB::table('compras as c')
                ->select('u.name', 'p.preco', 'c.status', 'c.id')
                ->join('itens_compra as i', 'c.id', 'i.compra_id')
                ->join('products as p', 'i.product_id', 'p.id')
                ->join('users as u', 'c.user_id', 'u.id')
                ->where('p.user_id', Auth::user()->id)
                ->paginate(10);
        } else {

            $compras = Compra::where('user_id', Auth::id())->paginate(10);
        }

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
        $if_credit = $this->perfilRepository->if_exist_credit($user_id);
        if ($if_credit) {
            $valorItens = $this->compraRepository->valorItensCarrinho($user_id);

            $this->perfilRepository->updateCreditVendedorEComprador($user_id, $valorItens);

            $this->compraRepository->finalizarCompra($valorItens, $user_id);
            return redirect()->back();
        } else {
            return redirect()->back()->with('warning', 'Crédito insuficiente');
        }
    }
}
