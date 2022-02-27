<?php

namespace App\Http\Requests;

use App\Models\Reklama;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateReklamaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('reklama_edit');
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
