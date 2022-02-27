<?php

namespace App\Http\Requests;

use App\Models\Sorovnoma;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSorovnomaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sorovnoma_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
