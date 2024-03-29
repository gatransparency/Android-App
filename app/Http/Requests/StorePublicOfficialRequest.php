<?php

namespace App\Http\Requests;

use App\Models\PublicOfficial;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePublicOfficialRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('public_official_create');
    }

    public function rules()
    {
        return [
            'agency_id' => [
                'required',
                'integer',
            ],
            'public_official_number' => [
                'string',
                'min:2',
                'max:50',
                'required',
                'unique:public_officials',
            ],
            'first_name' => [
                'string',
                'min:2',
                'max:25',
                'required',
            ],
            'middle_name' => [
                'string',
                'min:2',
                'max:25',
                'nullable',
            ],
            'last_name' => [
                'string',
                'min:2',
                'max:25',
                'required',
            ],
            'badge_employee_number' => [
                'string',
                'min:2',
                'max:25',
                'nullable',
            ],
            'sex' => [
                'string',
                'min:2',
                'max:10',
                'nullable',
            ],
            'rank' => [
                'string',
                'min:2',
                'max:25',
                'nullable',
            ],
            'officer_key_number' => [
                'string',
                'min:2',
                'max:25',
                'nullable',
            ],
            'hired' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'years_in_profession' => [
                'string',
                'min:2',
                'max:25',
                'nullable',
            ],
            'phone_number' => [
                'string',
                'min:2',
                'max:25',
                'nullable',
            ],
            'accuracy' => [
                'string',
                'required',
            ],
            'signature' => [
                'string',
                'min:2',
                'max:25',
                'required',
            ],
            'initials' => [
                'string',
                'min:2',
                'max:10',
                'required',
            ],
        ];
    }
}
