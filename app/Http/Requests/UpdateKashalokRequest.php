<?php

namespace App\Http\Requests;

use App\Models\Kashalok;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateKashalokRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('kashalok_edit');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'summa' => [
                'numeric',
                'required',
                'min:0',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
