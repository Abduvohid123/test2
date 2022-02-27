<?php

namespace App\Http\Requests;

use App\Models\ProgolSystem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyProgolSystemRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('progol_system_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:progol_systems,id',
        ];
    }
}
