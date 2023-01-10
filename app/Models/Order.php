<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'city',
        'status',
        'total_price',
    ];



    public function order_product()
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'order_id');
    }
}
