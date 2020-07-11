<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Rules\UniqueCheck;
use App\User;

class UserRequest extends FormRequest
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
            'name' => [
                'required',
                'max:80'
            ],
            'email' => [
                'required',
                'max:60',
                'email',
                new UniqueCheck(User::class)
            ],
            'password' => 'min:6'
        ];
    }
}
