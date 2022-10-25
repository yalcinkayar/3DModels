<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductsImage extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'products_id', 'image'];

    
    /*public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }*/

    public function product(){
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }
}
