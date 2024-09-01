<?php

namespace App\Models;

use App\Traits\LogsModelEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Tag extends Model
{
    use HasFactory, SoftDeletes, HasRoles;
     public function posts()
     {
         return $this->belongsToMany(Post::class, 'post_tag');
     }
}
