<?php

namespace App\Http\Requests;

use App\Models\Viloyatlar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreViloyatlarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('viloyatlar_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
