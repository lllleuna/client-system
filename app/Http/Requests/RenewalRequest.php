<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RenewalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'consent' => 'accepted',
            'oath' => 'accepted',
            'letter_request' => 'required|file|mimes:pdf,jpg,jpeg,png|max:8048',
            'g-recaptcha-response' => 'required|recaptcha',
        ];
    }
    
    public function messages()
    {
        return [
            'consent.accepted' => 'Please provide your consent to continue.',
            'oath.accepted' => 'Please certify that all information is true and correct.',
            'g-recaptcha-response.required' => 'Please confirm you are not a robot.',
            'g-recaptcha-response.recaptcha' => 'Captcha verification failed, please try again.',
        ];
    }
    

}
