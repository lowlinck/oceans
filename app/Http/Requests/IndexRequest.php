<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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
        $statuses = ['draft', 'published', 'archived'];
        return [
            'title' => 'nullable|string',
            'content' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'nullable|integer|in:' . implode(',', $statuses),
            'categories' => 'nullable|array',
            'categories.*' => 'nullable|integer|exists:categories,id',
            'category_title' => 'nullable|string',
            'created_at_from' => 'nullable|date_format:Y-m-d',
            'created_at_to' => 'nullable|date_format:Y-m-d',
        ];
    }

    public function messages()
    {
        $statuses = ['draft', 'published', 'archived'];
        return [
            'title.string' => 'Title must be a string.',
            'content.string' => 'Content must be a string.',
            'description.string' => 'Description must be a string.',
            'status.integer' => 'Status must be an integer.',
            'status.in' => 'Status must be one of the following values: ' . implode(', ', $statuses),
            'categories.array' => 'Categories must be an array.',
            'categories.*.integer' => 'Each category ID must be an integer.',
            'categories.*.exists' => 'Each category ID must exist in the categories table.',
            'category_title.string' => 'Category title must be a string.',
            'created_at_from.date_format' => 'Created at from must be a date in the format Y-m-d.',
            'created_at_to.date_format' => 'Created at to must be a date in the format Y-m-d.',
        ];
    }
}
