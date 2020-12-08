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
            ],
            'website' => ['nullable', 'present', 'url'],
            'profession_id' => [
                'nullable', 'present',
                Rule::exists('professions', 'id')
            ],
        ];

        if ($this->filled('password')) {
            $rules['password'] = 'required|min:8|confirmed';
        }

        return $rules;
    }

    public function updateUser(User $user)
    {
        $user->fill([
            'team_id' => $this->team_id,
            'name' => $this->name,
            'email' => $this->email,
            'state' => $this->state
        ]);

        if ($this->password != null) {
            $user->password = $this->password;
        }

        $user->save();

        $user->profile->update([
           'user_id' => $user->id,
           'profession_id' => $this->profession_id,
           'website' => $this->website,
           'phone_number' => $this->phone_number,
       ]);

        $user->skills()->sync($this->skills ?: []);
    }
}
