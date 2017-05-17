<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ReservationReviewPackageTourRequest extends Request
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
            'reservation_status_id' => 'required',
            'remarks' => 'required | max:500'
        ];
    }
}
