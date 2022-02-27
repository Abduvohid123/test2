<?php

namespace App\Http\Requests;

use App\Models\QoshimaChiqimlar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreQoshimaChiqimlarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('qoshima_chiqimlar_create');
    }

    public function rules()
    {
        return [
            'chiqim_sababi' => [
                'required',
            ],
            'summa' => [
                'numeric',
                'required',
            ],
            'kim_tarafidan_olindi_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
