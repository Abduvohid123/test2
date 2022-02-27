<?php

namespace App\Http\Requests;

use App\Models\OtaOna;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOtaOnaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ota_ona_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'phone_number' => [
                'string',
                'nullable',
            ],
        ];
    }
}
