<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImgProduct extends Model
{
    use HasFactory;
    protected $table = 'img_products';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
