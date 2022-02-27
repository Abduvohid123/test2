@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.student.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.students.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.id') }}
                        </th>
                        <td>
                            {{ $student->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.name') }}
                        </th>
                        <td>
                            {{ $student->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.birth_day') }}
                        </th>
                        <td>
                            {{ $student->birth_day }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $student->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.groups') }}
                        </th>
                        <td>
                            @foreach($student->groups as $key => $groups)
                                <span class="label label-info">{{ $groups->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.image') }}
                        </th>
                        <td>
                            @if($student->image)
                                <a href="{{ $student->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $student->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Student::STATUS_SELECT[$student->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.jinsi') }}
                        </th>
                        <td>
                            {{ App\Models\Student::JINSI_SELECT[$student->jinsi] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.weeks') }}
                        </th>
                        <td>
                            @foreach($student->weeks as $key => $weeks)
                                <span class="label label-info">{{ $weeks->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.start_time') }}
                        </th>
                        <td>
                            {{ $student->start_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.end_time') }}
                        </th>
                        <td>
                            {{ $student->end_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.tuman') }}
                        </th>
                        <td>
                            {{ $student->tuman->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.address') }}
                        </th>
                        <td>
                            {{ $student->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.reklama') }}
                        </th>
                        <td>
                            {{ $student->reklama->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.user') }}
                        </th>
                        <td>
                            {{ $student->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.filial') }}
                        </th>
                        <td>
                            {{ $student->filial->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.students.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection