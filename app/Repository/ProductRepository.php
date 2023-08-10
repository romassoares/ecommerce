<?php

namespace App\Repository;

use App\Models\ImgProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductRepository
{
    private $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function saveProduct($data)
    {
        $data['user_id'] = Auth::id();

        $result = $this->product->create($data);
        return $result ? $result : false;
    }

    public function findProductShow($data)
    {
        $product = $this->product->find($data);
        return $product;
    }

    public function updateProduct($data, $model)
    {
        $result = $model->update($data);

        return $result;
    }

    public function addImg($product_id, $data)
    {
        $product = $this->product->find($product_id);

        if ($product->imgs()->get()->count() < 3) {
            $imgPath = $data->img->store('image', 'public');

            $save = ImgProduct::insert([
                'product_id' => $product_id,
                'url' => $imgPath
            ]);
            return $save;
        }

        return false;
    }

    public function existImg($id)
    {
        return ImgProduct::find($id);
    }

    public function removeImg($img)
    {
        $filePath = public_path('storage/' . $img->url);

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $img->delete();
    }
}
