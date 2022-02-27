<?php

namespace App\Http\Requests;

use App\Models\Worker;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateWorkerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('worker_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:workers,name,' . request()->route('worker')->id,
            ],
            'position_id' => [
                'required',
                'integer',
            ],
            'phone_number_1' => [
                'string',
                'required',
            ],
            'sallary' => [
                'numeric',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
