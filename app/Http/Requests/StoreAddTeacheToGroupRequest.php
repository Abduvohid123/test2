<?php

namespace App\Http\Requests;

use App\Models\AddTeacheToGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAddTeacheToGroupRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('add_teache_to_group_create');
    }

    public function rules()
    {
        return [
            'teachers.*' => [
                'integer',
            ],
            'teachers' => [
                'required',
                'array',
            ],
            'sallary_type' => [
                'required',
            ],
            'oylik' => [
                'numeric',
                'required',
            ],
        ];
    }
}
