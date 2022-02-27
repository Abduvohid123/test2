<?php

namespace App\Http\Requests;

use App\Models\Group;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreGroupRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('group_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:groups',
            ],
            'room_id' => [
                'required',
                'integer',
            ],
            'cost' => [
                'numeric',
                'required',
            ],
            'status' => [
                'required',
            ],
            'start' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'finish' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'days.*' => [
                'integer',
            ],
            'days' => [
                'array',
            ],
            'start_cource' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
