<?php

namespace App\Http\Requests;

use App\Models\SavolType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSavolTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('savol_type_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'sorovnoma_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
