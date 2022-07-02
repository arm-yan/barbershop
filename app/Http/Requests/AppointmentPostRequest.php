<?php

namespace App\Http\Requests;


class AppointmentPostRequest extends Request
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
            'date'       => 'required|date',
            'slot'       => 'required',
            'email'      => 'required|email',
            'first_name' => 'required',
            'last_name'  => 'required',
            'service'    => 'required|exists:services,id'
        ];
    }
}
