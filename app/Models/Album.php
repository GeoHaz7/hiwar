<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    public function imagable()
    {
        return $this->morphTo();
    }

    public function images()
    {
        return $this->belongsTo(Image::class, 'image_id', 'image_id');
    }
}
