@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.otaOna.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ota-onas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.otaOna.fields.id') }}
                        </th>
                        <td>
                            {{ $otaOna->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.otaOna.fields.name') }}
                        </th>
                        <td>
                            {{ $otaOna->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.otaOna.fields.student') }}
                        </th>
                        <td>
                            {{ $otaOna->student->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.otaOna.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\OtaOna::STATUS_SELECT[$otaOna->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.otaOna.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $otaOna->phone_number }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ota-onas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection