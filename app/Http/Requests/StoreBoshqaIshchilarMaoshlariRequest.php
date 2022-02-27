<?php

namespace App\Http\Requests;

use App\Models\BoshqaIshchilarMaoshlari;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBoshqaIshchilarMaoshlariRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('boshqa_ishchilar_maoshlari_create');
    }

    public function rules()
    {
        return [
            'worker_id' => [
                'required',
                'integer',
            ],
            'summa' => [
                'numeric',
                'required',
            ],
            'bonus' => [
                'numeric',
                'required',
            ],
            'jarima' => [
                'numeric',
                'required',
            ],
        ];
    }
}
