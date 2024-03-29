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
            'agency_id' => [
                'required',
                'integer',
            ],
            'public_official_id' => [
                'required',
                'integer',
            ],
            'narrative' => [
                'required',
            ],
            'file' => [
                'array',
            ],
            'status' => [
                'required',
            ],
            'entered_by_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
