<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(errorResponse($validator->errors()->all(), 422));
    }

    protected function exception($message,$code){
        throw new HttpResponseException(errorResponse($message,$code));
    }
}
