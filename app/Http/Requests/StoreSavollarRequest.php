<?php

namespace App\Http\Requests;

use App\Models\Savollar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSavollarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('savollar_create');
    }

    public function rules()
    {
        return [
            'savol_title' => [
                'required',
            ],
            'savol_type_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
