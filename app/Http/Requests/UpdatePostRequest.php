<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
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
        $rules = [
            'title' => [
                'required',
                Rule::unique('posts')->ignore($this->route('post')->id)
            ],
            'body' => 'required',
            'category_id' => 'required',
            'excerpt' => 'required'
        ];

        if ($this->filled('password')) {
            $rules['password'] = 'required|min:8|confirmed';
        }

        return $rules;
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
