<?php

namespace App\Models;

use App\Traits\LogsModelEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory, SoftDeletes;
     public function posts()
     {
         return $this->belongsToMany(Post::class, 'post_tag');
     }
}
