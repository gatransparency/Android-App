<?php

namespace App\Http\Requests;

use App\Models\Form;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFormRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('form_edit');
    }

    public function rules()
    {
        return [
            'form_number' => [
                'string',
                'min:2',
                'max:50',
                'required',
            ],
            'form_name' => [
                'string',
                'min:2',
                'max:100',
                'required',
            ],
            'form_format' => [
                'required',
            ],
            'form' => [
                'array',
                'required',
            ],
            'form.*' => [
                'required',
            ],
        ];
    }
}
