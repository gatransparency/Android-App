<?php

namespace App\Http\Requests;

use App\Models\AgenciesOffice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAgenciesOfficeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('agencies_office_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:agencies_offices,id',
        ];
    }
}
