<?php

namespace App\Http\Requests;

use App\Models\SubmitRecord;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySubmitRecordRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('submit_record_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:submit_records,id',
        ];
    }
}
