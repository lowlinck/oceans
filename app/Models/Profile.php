<?php

namespace App\Models;

use App\Enums\RoleEnum;
use App\Traits\LogsModelEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Profile extends Model
{
    use HasFactory, SoftDeletes, HasRoles;
    protected $guard_name = 'web';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function likes()
    {
        return $this->belongsToMany(Post::class, 'likes')->withTimestamps();
    }


    protected $casts = [
        'role' => RoleEnum::class,
    ];

}
