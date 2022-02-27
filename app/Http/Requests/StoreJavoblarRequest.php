<?php

namespace App\Http\Requests;

use App\Models\Javoblar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreJavoblarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('javoblar_create');
    }

    public function rules()
    {
        return [
            'javob' => [
                'required',
            ],
            'savol_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
