<?php

namespace App\Http\Requests;

use App\Models\QoshimaChiqimlar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyQoshimaChiqimlarRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('qoshima_chiqimlar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:qoshima_chiqimlars,id',
        ];
    }
}
