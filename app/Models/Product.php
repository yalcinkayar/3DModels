<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductsImage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'title', 'price', 'description'];

    public function images()
    {
        return $this->hasMany(ProductsImage::class, 'products_id', 'id');
    }
}