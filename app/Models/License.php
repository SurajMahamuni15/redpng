<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
