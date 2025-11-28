<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function images()
    {
        return $this->belongsToMany(Image::class, 'image_tags');
    }
}
