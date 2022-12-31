<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;
        use HasFactory,
        SoftDeletes;
    protected $primaryKey = 'image_id';
    protected $fillable = [
        'original_filename',
        'filename',
    ];
}
