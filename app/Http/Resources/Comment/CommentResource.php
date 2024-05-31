<?php

namespace App\Http\Resources\Comment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        'id' => $this->id,
            'content' => $this->content,
            'profile' => [
        'id' => $this->profile->id,
        'first_name' => $this->profile->first_name,
        'second_name' => $this->profile->second_name,
        'age' => $this->profile->age,
        // Добавьте другие поля, если нужно
    ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            ];
    }
}
