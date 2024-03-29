<?php

namespace App\Http\Requests;

use App\Models\CaseLaw;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCaseLawRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('case_law_create');
    }

    public function rules()
    {
        return [
            'docket_number' => [
                'string',
                'min:2',
                'max:50',
                'required',
            ],
            'court' => [
                'string',
                'min:2',
                'max:100',
                'required',
            ],
            'case' => [
                'string',
                'min:2',
                'max:100',
                'required',
            ],
            'decided' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'case_narrative' => [
                'required',
            ],
            'judge' => [
                'string',
                'min:2',
                'max:50',
                'required',
            ],
            'case_file' => [
                'array',
            ],
            'added_by' => [
                'string',
                'min:2',
                'max:50',
                'required',
            ],
        ];
    }
}
