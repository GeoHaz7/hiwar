<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhotoAlbum extends Model
{
    use HasFactory,
        SoftDeletes,
        CascadeSoftDeletes;

    protected $primaryKey = 'photoAlbum_id';
    // protected $cascadeDeletes = ['images'];

    protected $fillable = [
        'image_id',
        'imagable_type',
        'imagable_id',
    ];

    public function imagable()
    {
        return $this->morphTo();
    }

    public function images()
    {
        return $this->belongsTo(Image::class, 'image_id', 'image_id');
    }
}
