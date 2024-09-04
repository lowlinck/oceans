<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\TagsResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class  PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' =>$this->id ,
            'title' => $this->title,
            'content' => $this->content,
            'description' => $this->description,
            'image' => $this->image_path,
            'preview_path' => $this->preview_path,
            'preview_url' => Storage::disk('public')->url($this->preview_path),
            'category_id' => $this->category_id ?? 2,
            'tags' => TagsResource::make($this->tags)->resolve(),
            'author_id' =>$this->author_id,
            'is_blocked' => $this->is_blocked,
            'view' => $this->view,
        ];
    }
}
