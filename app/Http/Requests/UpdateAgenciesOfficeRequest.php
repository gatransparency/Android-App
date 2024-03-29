<?php

namespace App\Http\Requests;

use App\Models\AgenciesOffice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAgenciesOfficeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('agencies_office_edit');
    }

    public function rules()
    {
        return [
            'agency_name' => [
                'string',
                'min:2',
                'max:100',
                'required',
            ],
            'street_address' => [
                'string',
                'min:2',
                'max:100',
                'required',
            ],
            'street_address_additional' => [
                'string',
                'min:2',
                'max:50',
                'nullable',
            ],
            'city' => [
                'string',
                'min:2',
                'max:50',
                'required',
            ],
            'state' => [
                'string',
                'min:2',
                'max:50',
                'required',
            ],
            'zip' => [
                'string',
                'min:2',
                'max:50',
                'required',
            ],
            'website_url' => [
                'string',
                'min:2',
                'max:100',
                'nullable',
            ],
            'phone_number' => [
                'string',
                'min:2',
                'max:15',
                'required',
            ],
            'fax' => [
                'string',
                'min:2',
                'max:15',
                'nullable',
            ],
            'agency_rating' => [
                'string',
                'min:1',
                'max:10',
                'nullable',
            ],
        ];
    }
}
