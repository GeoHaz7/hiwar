<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';
    protected $fillable = [
        'name',
        'description',
        'price',
        'feature_image',
        'status',
        'vendor_id',
    ];

    public function thumbnail()
    {
        return $this->hasOne(Image::class, 'image_id', 'feature_image');
    }

    public function album()
    {
        return $this->morphMany(Album::class, 'imagable');
    }
}
