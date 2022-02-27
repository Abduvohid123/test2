@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.fan.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.fan.fields.id') }}
                        </th>
                        <td>
                            {{ $fan->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fan.fields.name') }}
                        </th>
                        <td>
                            {{ $fan->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fan.fields.price') }}
                        </th>
                        <td>
                            {{ $fan->price }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection