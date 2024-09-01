<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\GetPostRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\User\RoleUserResource;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Role;
use Illuminate\Http\Request;

class
AdminProfilePostController extends Controller
{
    public function getPosts(Request $request, $profile_id  )
    {


        $postsProfile= Post::where('profile_id', $profile_id)->get();

        $postsProfile= PostResource::collection($postsProfile);
        $name = Profile::where('id', $profile_id)->pluck('first_name')->first();


        return inertia('Profile/Post/Index', compact(
            'postsProfile','name'));
    }


    public function create()
    {
        return inertia('Profile/Post/Create');
    }
    public function show(Post $post)
    {

        $post = PostResource::make($post)->resolve();

        return inertia('Profile/Post/Show', compact('post'));
    }
}
