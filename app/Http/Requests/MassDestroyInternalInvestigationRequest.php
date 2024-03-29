<?php

namespace App\Http\Requests;

use App\Models\InternalInvestigation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyInternalInvestigationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('internal_investigation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:internal_investigations,id',
        ];
    }
}
