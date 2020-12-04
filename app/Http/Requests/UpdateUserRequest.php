<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($this->route('user')->id)
            ]
        ];

        if ($this->filled('password')) {
            $rules['password'] = 'required|min:8|confirmed';
        }

        return $rules;
    }

    public function updateUser(User $user)
    {
        $user->fill([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        if ($this->password != null) {
            $user->password = $this->password;
        }

        $user->save();

        $user->profile->update([
           'job_title' => $this->job_title,
           'website' => $this->website,
           'phone_number' => $this->phone_number,
       ]);

        $user->skills()->syncWithoutDetaching($this->skills ?: []);
    }
}
