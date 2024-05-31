<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
            'description' => $this->description,
            'image' => $this->image,
            'preview_way' => $this->preview_way,
            'category_id' => $this->category_id,
            'author_id' => $this->author_id,
            'view' => $this->view,
        ];
    }
}
