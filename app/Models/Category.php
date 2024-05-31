<?php

namespace App\Models;

use App\Traits\LogsModelEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'category_id');
    }

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
