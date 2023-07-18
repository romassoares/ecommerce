<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class itensCompra extends Model
{
    use HasFactory;
    protected $table = 'itens_compra';
    protected $fillable = ['user_id', 'product_id', 'compra_id'];

    public function product()
    {
        return $this->hasMany(Product::class, 'product_id');
    }

    public function compra()
    {
        return $this->hasMany(Compra::class);
    }
}
