<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PostService
{
    public static function index ($data){

//        return Cache::remember(getCasheKey($data), now()->addMinutes(60), function () use ($data) {
            return Post::filter($data)->paginate(10, ['*'],'page' , $data['page']); // Указываем пагинацию, 10 записей на страницу
//        });
    }


    public static function update(Post $post, array $data): Post
    {
        try {
            DB::beginTransaction();
           if ($data['post']['preview_path1'] != false){
               $data['post']['preview_path'] = $data['post']['preview_path1'];
           }
            unset($data['post']['preview_path1']);

            $tags = TagService::storeBatch($data['tags']);

            $post->update($data['post']);
            $post->tags()->sync($tags);
            $post->refresh();
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            print $exception->getMessage();
        }


        return $post;
    }

    public static function store($data): Post
    {
        try {
            DB::beginTransaction();
            $tags = TagService::storeBatch($data['tags']);
            $post = Post::create($data['post']);
            $post->tags()->sync($tags);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            $post = Post::factory()->make();
        }


        return $post;
    }
}
