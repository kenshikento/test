<?php

namespace App\Http\Requests\Api\Property;

use App\Models\Property;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePropertyFormRequest extends FormRequest
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
                'required',
                'string',
                'min:1'
            ],
            'property_type' => [
                'required',
                'string',
                'min:1',
                Rule::in(Property::PROPERTYTYPE)
            ], 
            'parent_property_id' => [
                'required',
                'exists:properties,id',
            ],
            'uprn' => [
                'required',
                'max:20'
            ],
            'address' => [
                'required',  
            ],
            'town' => [
                'required'
            ],
            'postcode' => [
                'required',
            ],
            'live' => [
                'required',
                'boolean'
            ],
        ];
    }
}
