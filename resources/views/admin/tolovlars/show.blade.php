@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tolovlar.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tolovlars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.tolovlar.fields.id') }}
                        </th>
                        <td>
                            {{ $tolovlar->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tolovlar.fields.group') }}
                        </th>
                        <td>
                            {{ $tolovlar->group->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tolovlar.fields.student') }}
                        </th>
                        <td>
                            {{ $tolovlar->student->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tolovlar.fields.year') }}
                        </th>
                        <td>
                            {{ $tolovlar->year }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tolovlar.fields.month') }}
                        </th>
                        <td>
                            {{ $tolovlar->month->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tolovlar.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Tolovlar::STATUS_SELECT[$tolovlar->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tolovlar.fields.summa') }}
                        </th>
                        <td>
                            {{ $tolovlar->summa }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tolovlar.fields.chegirma') }}
                        </th>
                        <td>
                            {{ $tolovlar->chegirma }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tolovlar.fields.tolov_turi') }}
                        </th>
                        <td>
                            {{ App\Models\Tolovlar::TOLOV_TURI_SELECT[$tolovlar->tolov_turi] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tolovlars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection