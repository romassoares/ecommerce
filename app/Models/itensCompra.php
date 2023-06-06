<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class itensCompra extends Model
{
    use HasFactory;
    protected $table = 'itens_compra';
    protected $fillable = ['user_id', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }
}
