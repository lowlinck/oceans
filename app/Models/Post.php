<?php

namespace App\Models;



use App\Traits\Blockable;
use App\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Node\Expr\Cast\String_;
use Spatie\Permission\Traits\HasRoles;

class Post extends Model
{
    use HasFactory, SoftDeletes, HasFilter,  Blockable, HasRoles;

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_posts');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag' );
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'profile_id');
    }
    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }
    public function likes()
    {
        return $this->belongsToMany(Profile::class, 'likes')->withTimestamps();
    }

    public function comments()
    {
        return $this->belongsToMany(Comment::class, 'comments_posts');
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function getTagsAsStringAttribute(): string
    {
        return implode(',', $this->tags->pluck('title')->toArray());
    }
}

