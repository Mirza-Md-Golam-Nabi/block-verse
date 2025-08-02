<?php
namespace App\Http\Requests\Articles;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return authUser()->hasRole('author');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'        => [
                'required',
                'string',
                'min:10',
                'max:255',
            ],

            'body'         => [
                'required',
                'string',
                'min:10',
                'max:65535',
            ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = null;

        if ($this->is('api/*')) {
            $response = failedValidationForApi($validator);
        }

        $exception = $validator->getException();

        throw (new $exception($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
