<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'Product_id';
    public $timestamps = false;

    protected $fillable = [
        'Product_name',
        'Category_name',
        'Brand_name',
        'Price',
        'Product_pic',
        'Brand_logo',
        'Avaliable_quantity'
    ];


}
