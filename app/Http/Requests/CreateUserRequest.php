<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class CreateUserRequest extends FormRequest
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
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => 'required|min:8|confirmed',
        ];
    }

    public function createUser()
    {
        DB::transaction(function () {
            $user = User::create([
                 'name' => $this->name,
                 'email' => $this->email,
                 'password' => $this->password
             ]);

            $user->save();

            $user->profile()->create([
                 'job_title' => $this->job_title,
                 'website' => $this->website,
                 'phone_number' => $this->phone_number,
             ]);
        });
    }
}
