<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserStoreRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    //set true to ensure validation run
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    //rules validation for the usercontroller.create
    public function rules()
    {
        return [
            'name' => 'required | min:5 | max:20',
            'email' => 'required | email',
            'password' => 'required | confirmed',
            'role_user_id' => 'required',
            'phone_number' => 'required | numeric | digits_between:10,13',
        ];
    }
}
