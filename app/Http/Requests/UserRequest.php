<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

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
            User::NAME     => ['required', 'string'],
            User::EMAIL    => ['required', 'string', 'email'],
            User::PASSWORD => ['string'],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $name     = strip_tags(trim($this->name));
        $email    = strip_tags(trim($this->email));
        $password = strip_tags(trim($this->password)) ?? null;

        $this->merge([
            User::NAME     => $name,
            User::EMAIL    => $email,
            User::PASSWORD => $password,
        ]);
    }
}
