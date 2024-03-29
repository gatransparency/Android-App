<?php

namespace App\Http\Requests;

use App\Models\Report;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreReportRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('report_create');
    }

    public function rules()
    {
        return [
            'report_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'report_number' => [
                'string',
                'min:2',
                'max:50',
                'required',
            ],
            'full_name' => [
                'string',
                'min:2',
                'max:50',
                'required',
            ],
            'date_of_occurance' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'location' => [
                'string',
                'min:2',
                'max:50',
                'required',
            ],
            'narrative' => [
                'required',
            ],
            'official_number_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
