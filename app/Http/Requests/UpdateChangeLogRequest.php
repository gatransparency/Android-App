<?php

namespace App\Http\Requests;

use App\Models\ChangeLog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateChangeLogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('change_log_edit');
    }

    public function rules()
    {
        return [
            'portal_version_id' => [
                'required',
                'integer',
            ],
            'change' => [
                'required',
            ],
            'log' => [
                'required',
            ],
        ];
    }
}
