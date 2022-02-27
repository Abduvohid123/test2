@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.savollar.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.savollars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.savollar.fields.id') }}
                        </th>
                        <td>
                            {{ $savollar->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.savollar.fields.savol') }}
                        </th>
                        <td>
                            {!! $savollar->savol !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.savollar.fields.savol_title') }}
                        </th>
                        <td>
                            {{ $savollar->savol_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.savollar.fields.savol_type') }}
                        </th>
                        <td>
                            {{ $savollar->savol_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.savollar.fields.filial') }}
                        </th>
                        <td>
                            {{ $savollar->filial->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.savollars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection