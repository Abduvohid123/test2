<?php

namespace App\Http\Requests;

use App\Models\Filial;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFilialRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('filial_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:filials',
            ],
        ];
    }
}
