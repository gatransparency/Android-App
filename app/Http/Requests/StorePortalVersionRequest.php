<?php

namespace App\Http\Requests;

use App\Models\PortalVersion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePortalVersionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('portal_version_create');
    }

    public function rules()
    {
        return [
            'portal_version' => [
                'string',
                'min:2',
                'max:50',
                'nullable',
            ],
        ];
    }
}
