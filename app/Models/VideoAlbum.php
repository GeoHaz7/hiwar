<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoAlbum extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'video_id';

    protected $fillable = [
        'name',
        'link',
        'linkShortcut',
    ];
}
