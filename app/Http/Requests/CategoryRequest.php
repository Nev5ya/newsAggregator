<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class CategoryRequest extends FormRequest
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
    #[ArrayShape([
        'category' => "string",
        'slug' => "string"
    ])]
    public function rules(): array
    {
        return [
            'category' => 'required|string|min:3|max:20',
            'slug' => 'string|min:3|max:20'
        ];
    }

    #[ArrayShape([
        'category' => "string",
        'slug' => "string"
    ])]
    public function attributes(): array
    {
        return [
            'category' => 'название категории',
            'slug' => 'slug категории'
        ];
    }
}
