<?php
namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
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
            'post.title' => 'required|string',
            'post.content' => 'required|string',
            'post.description' => 'required|string',
            'post.preview_path' => 'nullable', // Добавляем валидацию файла
            'post.category_id' => 'required|integer|exists:categories,id',
            'tags' => 'nullable',
            'post.profile_id' => 'nullable|integer',
        ];
    }

    protected function passedValidation()
    {
        return $this->merge([
           'post' =>[
               ...$this->validated()['post'],
               'profile_id' => auth()->user()->id,
               'preview_path1' => isset($this->post['preview_path']) ? Storage::disk('public')->put('/preview_path', $this->post['preview_path']) : $this->post['preview_path'],
           ],
            'tags' => $this->tags ? explode(',', $this->tags) : []
        ]);

    }

}
