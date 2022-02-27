@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.kashalok.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.kashaloks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.kashalok.fields.id') }}
                        </th>
                        <td>
                            {{ $kashalok->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kashalok.fields.user') }}
                        </th>
                        <td>
                            {{ $kashalok->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kashalok.fields.summa') }}
                        </th>
                        <td>
                            {{ $kashalok->summa }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kashalok.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Kashalok::STATUS_SELECT[$kashalok->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.kashaloks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection