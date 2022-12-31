<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $primaryKey = 'news_id';
    protected $fillable = [
        'title',
        'brief',
        'description',
        'feature_image',
        'category',
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
