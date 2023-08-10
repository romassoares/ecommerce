<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'descricao', 'preco', 'categoria', 'user_id'];

    public function getPreco()
    {
        return 'R$' . number_format($this->preco, 2, ',', '.');
    }

    public function imgs()
    {
        return $this->hasMany(ImgProduct::class);
    }

    public function item()
    {
        return $this->belongsToMany(itensCompra::class);
    }

    public function compra()
    {
        return $this->belongsToMany(Compra::class, 'itens_compra', 'product_id', 'compra_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
