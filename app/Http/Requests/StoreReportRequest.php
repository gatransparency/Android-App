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
            'gtnn_number_id' => [
                'required',
                'integer',
            ],
            'agency_id' => [
                'required',
                'integer',
            ],
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
            'date_of_occurance' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'full_name' => [
                'string',
                'min:2',
                'max:50',
                'required',
            ],
            'time' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
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
            'report_status' => [
                'required',
            ],
            'release' => [
                'required',
            ],
            'admin_signature' => [
                'string',
                'min:2',
                'max:75',
                'required',
            ],
            'date_approved' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
