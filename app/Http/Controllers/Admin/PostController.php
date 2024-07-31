<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Post\StoreRequest;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Http\Requests\IndexRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Post\PostForEditResource;
use App\Http\Resources\Post\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request)
    {

        $data = $request->validationData();
        $posts = PostService::index($data);
        $posts = PostResource::collection($posts);

        if ($request->wantsJson()) {

            return $posts;
        }

        return inertia('Admin/Post/Index', compact('posts', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = CategoryResource::collection(Category::all())->resolve();

        return inertia('Admin/Post/Create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        $data = $request->validated();
        $data ['post']['preview_path'] = Storage::disk('public')->put('/preview_path', $data['post']['preview_path']);
//        unset($data['post']['preview_path']);

        $post = PostService::store($data);

        return PostResource::make($post)->resolve();

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {

        $post = PostResource::make($post)->resolve();

        return inertia('Post/Show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $post = PostForEditResource::make($post)->resolve();

        $categories = CategoryResource::collection(Category::all())->resolve();
        return inertia('Admin/Post/Edit', compact('post', 'categories')) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Post $post)
    {

        $data = $request->validationData();

//        $data ['post']['preview_path'] = Storage::disk('public')->put('/preview_path', $data['post']['preview_path']);
        $post = PostService::update($post, $data);
        return PostResource::make($post)->resolve();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(POST $post)

    {

        $post->delete();
        Cache::flush();
        return Response::HTTP_NO_CONTENT;
    }
}
