<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_product_id';
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
    ];


    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'product_id', 'product_id');
    }
}
