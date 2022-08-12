<?php

namespace App\Http\Requests\Api\Certificate;

use Illuminate\Foundation\Http\FormRequest;

class CreateCertificateFormRequest extends FormRequest
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
            'stream_name' => [
                'required',
                'string',
            ],
            'property_id' => [
                'required',
                'exists:properties,id'
            ],
            'issue_date' => [
                'required',
                'date'
            ],
            'next_due_date' => [
                'required',
                'date'
            ],
        ];
    }
}