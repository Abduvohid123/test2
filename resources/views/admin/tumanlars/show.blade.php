@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tumanlar.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tumanlars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.tumanlar.fields.id') }}
                        </th>
                        <td>
                            {{ $tumanlar->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tumanlar.fields.name') }}
                        </th>
                        <td>
                            {{ $tumanlar->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tumanlar.fields.viloyat') }}
                        </th>
                        <td>
                            {{ $tumanlar->viloyat->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tumanlars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection