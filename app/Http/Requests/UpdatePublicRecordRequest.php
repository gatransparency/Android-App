<?php

namespace App\Http\Requests;

use App\Models\PublicRecord;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePublicRecordRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('public_record_edit');
    }

    public function rules()
    {
        return [
            'request_number' => [
                'string',
                'min:2',
                'max:100',
                'required',
                'unique:public_records,request_number,' . request()->route('public_record')->id,
            ],
            'agency' => [
                'string',
                'min:2',
                'max:100',
                'required',
            ],
            'response_due' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'county' => [
                'string',
                'min:2',
                'max:100',
                'required',
            ],
            'state' => [
                'string',
                'min:2',
                'max:25',
                'required',
            ],
            'records_requested' => [
                'required',
            ],
            'status' => [
                'required',
            ],
            'file' => [
                'array',
            ],
        ];
    }
}
