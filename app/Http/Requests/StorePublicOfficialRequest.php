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
            'gtnn_number' => [
                'string',
                'min:2',
                'max:100',
                'required',
                'unique:public_officials',
            ],
            'name' => [
                'string',
                'min:2',
                'max:100',
                'required',
            ],
            'hired' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'badge_number' => [
                'string',
                'min:2',
                'max:50',
                'nullable',
            ],
            'rank_position' => [
                'string',
                'min:2',
                'max:50',
                'required',
            ],
            'okey_number' => [
                'string',
                'min:2',
                'max:50',
                'nullable',
            ],
            'years' => [
                'string',
                'min:2',
                'max:25',
                'nullable',
            ],
            'phone_number' => [
                'string',
                'min:2',
                'max:50',
                'nullable',
            ],
            'professionalism' => [
                'string',
                'min:1',
                'max:25',
                'nullable',
            ],
            'appearance' => [
                'string',
                'min:1',
                'max:25',
                'nullable',
            ],
            'uniform' => [
                'string',
                'min:1',
                'max:25',
                'nullable',
            ],
            'attitude' => [
                'string',
                'min:1',
                'max:25',
                'nullable',
            ],
            'law_knowledge' => [
                'string',
                'min:1',
                'max:10',
                'nullable',
            ],
            'rights_violations' => [
                'string',
                'min:1',
                'max:10',
                'nullable',
            ],
            'signature' => [
                'string',
                'min:2',
                'max:50',
                'required',
            ],
            'initials' => [
                'string',
                'min:1',
                'max:10',
                'required',
            ],
        ];
    }
}
