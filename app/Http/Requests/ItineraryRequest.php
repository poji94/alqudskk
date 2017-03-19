<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ItineraryRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    //rules validation for the ItineraryController.create -> ItineraryController.store
    //and ItineraryController.edit() -> ItineraryController.update
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
        $rules =  [
            'name' => 'required | min:5 | max:20',
            'description' => 'required | max:300',
            'duration' => 'required',
            'price' => 'required',
            'media_id' => 'array',
        ];

        $medias = $this->file('media_id');
        if(!empty($medias)) {
            foreach ($medias as $key=>$media) {
                $rules[ sprintf('media_id.%d', $key)] = 'image';
            }
        }
        return $rules;
    }
}
