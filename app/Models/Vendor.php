<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $primaryKey = 'vendor_id';
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
        return $this->hasOne(Images::class, 'images_id', 'profile_image');
    }
}
