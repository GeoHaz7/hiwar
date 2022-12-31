<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Product extends Model
{
    use HasFactory,
        SoftDeletes,
        CascadeSoftDeletes;
    protected $primaryKey = 'product_id';
    protected $appends = ['vendorName'];
    protected $cascadeDeletes = ['thumbnail', 'album'];

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

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'vendor_id');
    }

    public function getVendorNameAttribute()
    {

        return $this->vendor->full_name;
    }
}
