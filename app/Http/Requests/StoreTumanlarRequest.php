<?php

namespace App\Http\Requests;

use App\Models\Tumanlar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTumanlarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tumanlar_create');
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
