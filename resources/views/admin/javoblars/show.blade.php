@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.javoblar.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.javoblars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.javoblar.fields.id') }}
                        </th>
                        <td>
                            {{ $javoblar->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.javoblar.fields.javob') }}
                        </th>
                        <td>
                            {!! $javoblar->javob !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.javoblar.fields.savol') }}
                        </th>
                        <td>
                            {{ $javoblar->savol->savol_title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.javoblar.fields.filial') }}
                        </th>
                        <td>
                            {{ $javoblar->filial->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.javoblars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection