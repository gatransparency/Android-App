<?php

namespace App\Http\Requests;

use App\Models\Record;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRecordRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('record_create');
    }

    public function rules()
    {
        return [
            'date_added' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
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
