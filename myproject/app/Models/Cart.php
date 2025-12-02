<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'Cart_id';
    public $timestamps = false;

    protected $fillable = [
        'User_id',
        'Product_id',
        'Size',
        'Quantity',
        'Price',
        'Total_price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'Product_id', 'Product_id');
    }
}
