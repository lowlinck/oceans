<?php

namespace App\Http\Requests\Api\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'content' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|string',
            'preview_way' => 'required|string',
            'category_id' => 'required|integer', // Добавлено правило для category_id
            'author_id' => 'required|integer', // Добавлено правило для author_id
            'view' => 'required|integer',
        ];
    }
}
