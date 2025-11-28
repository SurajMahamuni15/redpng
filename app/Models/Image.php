<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function license()
    {
        return $this->belongsTo(License::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploader_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'image_tags');
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
}
