<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:posts',
            'body' => 'required',
            'category_id' => 'required',
            'excerpt' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'title.unique' => 'The title must be unique',
            'body.required' => 'A body is required',
            'category_id.required' => 'A category is required',
            'excerpt.required' => 'A excerpt is required',
        ];
    }
}
