<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'post.title' => 'required|string',
            'post.content' => 'required|string',
            'post.description' => 'required|string',
            'post.preview_path' => 'nullable|file',
            'post.category_id' => 'required|integer|exists:categories,id',
            'tags' => 'nullable',
            'post.profile_id'=>'nullable' ?? 1,

        ];
    }

    protected function prepareForValidation()
    {

        $this->merge([
            'post' => array_merge($this->post, [
                'profile_id' => 3,

            ]),
            'tags' => $this->tags ? explode(',', $this->tags) : [],
        ]);

    }
}
