@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.savolType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.savol-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.savolType.fields.id') }}
                        </th>
                        <td>
                            {{ $savolType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.savolType.fields.name') }}
                        </th>
                        <td>
                            {{ $savolType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.savolType.fields.sorovnoma') }}
                        </th>
                        <td>
                            {{ $savolType->sorovnoma->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.savolType.fields.filial') }}
                        </th>
                        <td>
                            {{ $savolType->filial->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.savol-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection