<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Http\Request;

class CategoryPostsController extends Controller
{
    public function getPosts(Request $request, $category_id  )
    {


        $postsProfile= Post::where('category_id', $category_id)->get();

        $postsCategory= PostResource::collection($postsProfile);
        $name = Category::where('id', $category_id)->pluck('title')->first();


        return inertia('Admin/Category/Post/Index', compact(
            'postsCategory','name'));
    }
}
