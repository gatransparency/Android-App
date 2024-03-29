<?php

namespace App\Http\Requests;

use App\Models\PortalVersion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPortalVersionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('portal_version_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:portal_versions,id',
        ];
    }
}
