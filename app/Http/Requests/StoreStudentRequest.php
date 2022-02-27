<?php

namespace App\Http\Requests;

use App\Models\Student;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStudentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('student_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:students',
            ],
            'birth_day' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'phone_number' => [
                'string',
                'nullable',
            ],
            'groups.*' => [
                'integer',
            ],
            'groups' => [
                'array',
            ],
            'status' => [
                'required',
            ],
            'weeks.*' => [
                'integer',
            ],
            'weeks' => [
                'array',
            ],
            'start_time' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'end_time' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'address' => [
                'string',
                'nullable',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
