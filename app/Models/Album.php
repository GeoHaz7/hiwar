<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Album extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'album_id';
    public $appends = ['image_counter'];


    protected $fillable = [
        'name',
        'description',
        'feature_image',
    ];

    public function thumbnail()
    {
        return $this->hasOne(Image::class, 'image_id', 'feature_image');
    }

    public function album()
    {
        return $this->morphMany(PhotoAlbum::class, 'imagable');
    }

    public function getImageCounterAttribute()
    {
        return $this->album()->count();
    }
}
