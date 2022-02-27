<?php

namespace App\Http\Requests;

use App\Models\AddTeacheToGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAddTeacheToGroupRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('add_teache_to_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:add_teache_to_groups,id',
        ];
    }
}
