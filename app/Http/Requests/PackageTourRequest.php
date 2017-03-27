<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PackageTourRequest extends Request
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
            'name' => 'required | min:5 | max:20 | unique:package_tours',
            'description' => 'required | max:300',
            'duration' => 'required',
            'price_children' => 'required',
            'price_adult' => 'required',
        ];
    }
}
