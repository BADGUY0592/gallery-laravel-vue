<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $table = 'galleries';

    protected $fillable = [
        'image_name',
        'image_width',
        'image_height',
        'image_size',
        'image_extension',
        'image_lat',
        'image_long',
        'image',
        'user_name',
    ];
    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return config('app.url').'/storage/'.$this->image;
    }
}
