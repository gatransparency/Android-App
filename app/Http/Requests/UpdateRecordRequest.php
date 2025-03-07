<?php

namespace App\Http\Requests;

use App\Models\Record;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRecordRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('record_edit');
    }

    public function rules()
    {
        return [
            'full_name' => [
                'string',
                'min:2',
                'max:75',
                'required',
            ],
            'record_type' => [
                'string',
                'min:2',
                'max:50',
                'required',
            ],
            'record' => [
                'array',
            ],
            'entered_by' => [
                'string',
                'min:2',
                'max:50',
                'required',
            ],
            'gtnn_number_id' => [
                'required',
                'integer',
            ],
            'agency_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
