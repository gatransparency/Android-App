<?php

namespace App\Http\Requests;

use App\Models\ChangeLog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyChangeLogRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('change_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:change_logs,id',
        ];
    }
}
