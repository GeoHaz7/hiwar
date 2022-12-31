<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Vendor extends Model
{
    use HasFactory,
        SoftDeletes,
        CascadeSoftDeletes;

    protected $primaryKey = 'vendor_id';
    protected $cascadeDeletes = ['user', 'products'];
    protected $fillable = [
        'full_name',
        'bio',
        'status',
        'address',
        'phone',
        'user_id',
        'profile_image'
    ];



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function thumbnail()
    {
        return $this->hasOne(Image::class, 'image_id', 'profile_image');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'vendor_id');
    }
}
