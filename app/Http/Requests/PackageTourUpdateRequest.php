<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PackageTourUpdateRequest extends Request
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
            'name' => 'required | min:5 | max:50',
            'description' => 'required | max:5000',
            'duration' => 'required',
            'price_children' => 'required | integer | min:1',
            'price_adult' => 'required | integer | min:1',
        ];
    }
}
