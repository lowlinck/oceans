<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\TagsResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PostForEditResource extends JsonResource
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
            'category_id' => $this->category_id,
            'tags' => $this->tags_as_string,
            'author_id' =>$this->author_id,
            'view' => $this->view,
        ];
    }
}
