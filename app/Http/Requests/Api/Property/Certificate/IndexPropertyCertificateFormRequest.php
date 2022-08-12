<?php

namespace App\Http\Requests\Api\Property\Certificate;

use Illuminate\Foundation\Http\FormRequest;

class IndexPropertyCertificateFormRequest extends FormRequest
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
            'limit' => [
                'required',
                'numeric',
            ],
        ];
    }
}