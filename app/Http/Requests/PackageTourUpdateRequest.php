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
            'duration' => 'required | numeric',
            'personal' => 'required | integer | min:1',
            'private_group_children' => 'required | integer | min:1',
            'private_group_adult' => 'required | integer | min:1',
            'public_group_children' => 'required | integer | min:1',
            'public_group_adult' => 'required | integer | min:1',
            'media_id' => 'array',
        ];

        //each image must validated as image file before accepted
        $medias = $this->file('media_id');
        if(!empty($medias)) {
            foreach ($medias as $key=>$media) {
                $rules[ sprintf('media_id.%d', $key)] = 'image';
            }
        }
        return $rules;
    }
}
