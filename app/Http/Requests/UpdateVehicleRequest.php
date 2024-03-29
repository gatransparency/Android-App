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
            'image' => [
                'array',
            ],
            'gtnn_number_id' => [
                'required',
                'integer',
            ],
            'agency_vehicle_id' => [
                'required',
                'integer',
            ],
            'year' => [
                'string',
                'min:2',
                'max:5',
                'required',
            ],
            'make' => [
                'string',
                'min:2',
                'max:25',
                'required',
            ],
            'model' => [
                'string',
                'min:2',
                'max:50',
                'required',
            ],
            'marked' => [
                'required',
            ],
            'style' => [
                'required',
            ],
            'condition' => [
                'required',
            ],
            'plate_number' => [
                'string',
                'min:2',
                'max:15',
                'nullable',
            ],
            'vehicle_number' => [
                'string',
                'min:2',
                'max:15',
                'nullable',
            ],
        ];
    }
}
