<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;
    use HasFactory,
        SoftDeletes,
        CascadeSoftDeletes;

    protected $primaryKey = 'image_id';
    // protected $cascadeDeletes = ['album'];

    protected $fillable = [
        'original_filename',
        'filename',
    ];

    // public function album()
    // {
    //     return $this->hasOne(Album::class, 'image_id', 'image_id');
    // }
}
