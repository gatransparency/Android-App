<?php

namespace App\Http\Requests;

use App\Models\Reportbug;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreReportbugRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('reportbug_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'min:2',
                'max:100',
                'required',
            ],
            'email' => [
                'required',
            ],
            'synopsis' => [
                'required',
            ],
        ];
    }
}
