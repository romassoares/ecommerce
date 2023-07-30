<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImgProductRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Repository\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    private $productRepository;
    private $product;

    public function __construct(ProductRepository $productRepository, Product $product)
    {
        $this->productRepository = $productRepository;
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = DB::table('products')->select('categoria')->distinct()->get();
        if (Auth::user()->type === 'adm') {
            $products = $this->product->paginate(10);
        } else {
            $products = $this->product->where('user_id', Auth::user()->id)->paginate(10);
        }

        return view('product.index', ['products' => $products, 'categorias' => $categorias]);
    }

    public function search(Request $request)
    {
        $query = $this->product->query();

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $save = $this->productRepository->saveProduct($request->validated());

        return redirect()->route('product.show', ['product_id' => $save->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($product_id)
    {
        $product = $this->productRepository->findProductShow($product_id);

        return view('product.show', ['product' => $product]);
    }

    public function img(ImgProductRequest $request, $product_id)
    {
        if ($request->hasFile('img') && $request->img->isValid()) {
            $this->productRepository->addImg($product_id, $request);

            return redirect()->route('product.show', ['product_id' => $product_id]);
        } else {
            return redirect()->back();
        }
    }

    public function ImgRemove($product_id, $img_id)
    {
        $img_exist = $this->productRepository->existImg($img_id);

        if ($img_exist) {

            $this->productRepository->removeImg($img_exist);

            return redirect()->route('product.show', ['product_id' => $product_id]);
        } else {
            return redirect()->back();
        }
    }

    public function edit($product_id)
    {
        $product = $this->productRepository->findProductShow($product_id);
        if ($product) {
            return view('product.form', ['product' => $product]);
        } else {
            return false;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $product_id)
    {
        $product = $this->productRepository->findProductShow($product_id);
        if ($product) {
            $validated = $request->validated();

            $this->productRepository->updateProduct($validated, $product);

            return redirect()->route('product.show', ['product_id' => $product->id]);
        } else {
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
