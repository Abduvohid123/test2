<?php

namespace App\Http\Requests;

use App\Models\Tolovlar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTolovlarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tolovlar_edit');
    }

    public function rules()
    {
        return [
            'group_id' => [
                'required',
                'integer',
            ],
            'student_id' => [
                'required',
                'integer',
            ],
            'year' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'month_id' => [
                'required',
                'integer',
            ],
            'status' => [
                'required',
            ],
            'summa' => [
                'numeric',
                'required',
            ],
            'chegirma' => [
                'numeric',
                'required',
            ],
            'tolov_turi' => [
                'required',
            ],
        ];
    }
}
