<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $emailValidation = auth()->user()?'required|email' : 'required|email|unique:users';
        return [
            'email'=>$emailValidation,
        ];
    }
    public function messages){
        return [
            'email.unque'| 'You Already Have An Account with this email. Please <a href="/login">login</a> to continue ',
        ];
    }

}
