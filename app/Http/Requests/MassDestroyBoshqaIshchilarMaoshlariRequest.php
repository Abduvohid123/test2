<?php

namespace App\Http\Requests;

use App\Models\BoshqaIshchilarMaoshlari;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBoshqaIshchilarMaoshlariRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('boshqa_ishchilar_maoshlari_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:boshqa_ishchilar_maoshlaris,id',
        ];
    }
}
