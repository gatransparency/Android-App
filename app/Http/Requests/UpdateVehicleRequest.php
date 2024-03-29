<?php

namespace App\Http\Requests;

use App\Models\Vehicle;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVehicleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('vehicle_edit');
    }

    public function rules()
    {
        return [
            'agency_id' => [
                'required',
                'integer',
            ],
            'image' => [
                'array',
            ],
            'make' => [
                'string',
                'min:2',
                'max:50',
                'nullable',
            ],
            'model' => [
                'string',
                'min:2',
                'max:50',
                'nullable',
            ],
            'year' => [
                'string',
                'min:2',
                'max:50',
                'nullable',
            ],
            'number' => [
                'string',
                'min:2',
                'max:50',
                'nullable',
            ],
        ];
    }
}
