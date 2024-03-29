<?php

namespace App\Http\Requests;

use App\Models\Bug;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBugRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bug_create');
    }

    public function rules()
    {
        return [
            'version_id' => [
                'required',
                'integer',
            ],
            'title' => [
                'string',
                'min:2',
                'max:100',
                'required',
            ],
            'status' => [
                'string',
                'min:2',
                'max:25',
                'required',
            ],
            'synopsis' => [
                'required',
            ],
            'fixed' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
