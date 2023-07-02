<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // $user = $this->route('user', new User());
        return [
            'name' => ['required','string','max:255','min:3'],
            'email' => ['required','string','email','max:50'],
            'password' => ['required','confirmed',Rules\Password::defaults()],
            'type' => ['required','in:user,admin,super-admin'],
            'status' => ['required','in:active,inactive,blocked'],
        ];
    }

    public function messages(): array
    {
        return [
            '*.required'  => ':attribute field can not be empty.',
            'name.max' => 'The name field must be less than 250 character!',
            'name.min' => 'The name field must be more than 3 characters!',
            'email' => 'The field must have correct email as : example@email.com',
            'password.min' => 'The password must be ,more than 6 characters!!',
            'confirmed' => 'The password must be conformid!',
        ];
    }
}
