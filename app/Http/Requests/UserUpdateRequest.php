<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
//            'name' => 'required|max:255|unique:users,name,' . $this->user->id,
//            'email' => 'required|max:255|email|unique:users,email,' . $this->user->id,
//            'password' => 'required|min:8|max:32',
        ];
    }

//    public function messages()
//    {
//
//    }
}
