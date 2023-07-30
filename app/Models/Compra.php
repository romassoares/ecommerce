<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'preco', 'status'];

    public function getPreco()
    {
        return 'R$' . number_format($this->preco, 2, ',', '.');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function itens()
    {
        return $this->belongsToMany(itensCompra::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'itens_compra', 'compra_id', 'product_id');
    }
}
