<?php

namespace App\Http\Requests;

use App\Models\PortalRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePortalRequestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('portal_request_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'min:2',
                'max:50',
                'required',
            ],
            'email' => [
                'required',
            ],
            'request' => [
                'required',
            ],
        ];
    }
}
