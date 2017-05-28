<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ReservationStorePackageTourRequest extends Request
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
            'packagetour_id' => 'required',
            'adult_no' => 'integer | min:1',
            'children_no' => 'integer',
            'price_type' => 'required',
            'main_reservation_start' => 'required',
            'alternate_reservation_start' => 'required | different:main_reservation_start',
        ];
    }
}
