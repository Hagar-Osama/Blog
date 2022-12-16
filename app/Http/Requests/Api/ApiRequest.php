<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

abstract class ApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract public function authorize();


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    abstract public function rules();

    protected function failedValidation(Validator $validator)
    {
        //this will show the list of errors from the request
        $errors = (new ValidationException($validator))->errors();

        if (!empty($errors)) {
            $errorMessages = [];
            foreach($errors as $field => $message) {
                $errorMessages[] = [
                    $field => $message[0]
                ];
            }
            //this method will return response of the error
            throw new HttpResponseException(
                response()->json([
                    'status' => 'error..',
                    'message' => $errorMessages

                ], JsonResponse::HTTP_BAD_REQUEST)
            );
        }

    }
}
