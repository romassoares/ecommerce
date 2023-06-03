<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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

        $productsApi = Http::get('https://dummyjson.com/products')->json();
        foreach ($productsApi['products'] as $product) {
            $prodId = DB::table('products')->insertGetId([
                'nome' => $product['title'],
                'descricao' => $product['description'],
                'preco' => $product['price'],
                'categoria' => $product['category'],
            ]);

            $imgs = $product['images'];

            foreach ($imgs as $img) {
                DB::table('img_products')->insert([
                    'url' => $img,
                    'product_id' => $prodId,
                ]);
            }
        }

        return $result ? true : false;
    }
}
