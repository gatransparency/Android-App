<?php

namespace App\Http\Requests;

use App\Models\CaseLaw;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCaseLawRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('case_law_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:case_laws,id',
        ];
    }
}
