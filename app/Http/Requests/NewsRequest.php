<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class NewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(
        ['title' => "string",
            'category_id' => "string",
            'author' => "string",
            'description' => "string",
            'image' => "string"
        ]
    )]
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:20',
            'category_id' => 'required|exists:App\Models\Category,id',
            'author' => 'required|string|min:4|max:20',
            'description' => 'required|string|min:10',
            'image' => 'mimes:jpeg,png,bmp,jpg|max:1000'
        ];
    }

    #[ArrayShape(
        [
            'title' => "string",
            'category_id' => "string",
            'image' => "string",
            'author' => "string"
        ]
    )]
    public function attributes(): array
    {
        return [
            'title' => 'заголовок',
            'category_id' => 'категории новости',
            'image' => 'изображение',
            'author' => 'автор'
        ];
    }
}
