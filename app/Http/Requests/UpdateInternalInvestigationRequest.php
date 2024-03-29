<?php

namespace App\Http\Requests;

use App\Models\InternalInvestigation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateInternalInvestigationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('internal_investigation_edit');
    }

    public function rules()
    {
        return [
            'ia_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'gtnn_number_id' => [
                'required',
                'integer',
            ],
            'agency_office_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'min:2',
                'max:50',
                'required',
            ],
            'investigator' => [
                'string',
                'min:2',
                'max:50',
                'required',
            ],
            'narrative' => [
                'required',
            ],
            'files' => [
                'array',
            ],
            'entered_by' => [
                'string',
                'min:2',
                'max:50',
                'required',
            ],
        ];
    }
}
