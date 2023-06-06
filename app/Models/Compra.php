<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'preco', 'compra_id'];

    public function itens()
    {
        return $this->hasMany(itensCompra::class);
    }
}
