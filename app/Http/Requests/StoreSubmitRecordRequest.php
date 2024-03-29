<?php

namespace App\Http\Requests;

use App\Models\SubmitRecord;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSubmitRecordRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('submit_record_create');
    }

    public function rules()
    {
        return [
            'role' => [
                'string',
                'min:2',
                'max:100',
                'required',
            ],
            'name' => [
                'string',
                'min:2',
                'max:100',
                'required',
            ],
            'agency_affiliation' => [
                'string',
                'min:2',
                'max:100',
                'required',
            ],
            'address' => [
                'string',
                'min:2',
                'max:100',
                'required',
            ],
            'image' => [
                'array',
            ],
            'files' => [
                'array',
            ],
            'narrative' => [
                'required',
            ],
        ];
    }
}
