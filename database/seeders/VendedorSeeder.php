<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class VendedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userId = DB::table('users')->insertGetId([
            'name' => Str::random(10),
            'email' => 'vendedor@email.com',
            'password' => Hash::make('1234qwer'),
            'type' => 'ven'
        ]);

        DB::table("ven_perfils")->insert([
            'user_id' => $userId,
            'status' => "pen"
        ]);

        $productsApi = Http::get('https://dummyjson.com/products')->json();
        foreach ($productsApi['products'] as $product) {
            $prodId = DB::table('products')->insertGetId([
                'user_id' => $userId,
                'nome' => $product['title'],
                'descricao' => $product['description'],
                'preco' => $product['price'],
                'categoria' => $product['category'],
            ]);

            $imgs = $product['images'];

            for ($i = 0; $i < min(3, count($imgs)); $i++) {
                DB::table('img_products')->insert([
                    'url' => $imgs[$i],
                    'product_id' => $prodId,
                ]);
            }
        }
    }
}
