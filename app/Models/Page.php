<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $primaryKey = 'page_id';
    protected $fillable = [
        'title',
        'brief',
        'description',
        'feature_image',
        'status',
    ];

    public function thumbnail()
    {
        return $this->hasOne(Image::class, 'image_id', 'feature_image');
    }

    public function album()
    {
        return $this->morphMany(PhotoAlbum::class, 'imagable');
    }
}
