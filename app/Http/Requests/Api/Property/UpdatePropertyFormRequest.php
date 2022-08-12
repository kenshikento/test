<?php

namespace App\Http\Requests\Api\Property;

use App\Models\Property;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePropertyFormRequest extends FormRequest
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
            'organisation' => [
                'sometimes',
                'required',
                'string',
                'min:1'
            ],
            'property_type' => [
                'sometimes',
                'required',
                'string',
                'min:1',
                Rule::in(Property::PROPERTYTYPE)
            ], 
            'parent_property_id' => [
                'sometimes',
                'required',
                'exists:properties,id',
            ],
            'uprn' => [
                'sometimes',
                'required',
                'max:20'
            ],
            'address' => [
                'sometimes',
                'required',  
            ],
            'town' => [
                'sometimes',
                'required'
            ],
            'postcode' => [
                'sometimes',
                'required',
            ],
            'live' => [
                'sometimes',
                'required',
                'boolean'
            ],
        ];
    }
}
