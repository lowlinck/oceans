<?php

namespace App\Models;

use App\Traits\HasFilter;
use App\Traits\LogsModelEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Comment extends Model
{
    use HasFactory, SoftDeletes, HasFilter,HasRoles;

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_comments');
    }
    public function likes()
    {
        return $this->morphMany('App\Models\Like', 'likeable');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'comments_posts');
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
