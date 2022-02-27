<?php

namespace App\Http\Requests;

use App\Models\ProgolSystem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProgolSystemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('progol_system_edit');
    }

    public function rules()
    {
        return [
            'day' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'group_id' => [
                'required',
                'integer',
            ],
            'student_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
