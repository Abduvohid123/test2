@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.worker.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.workers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.worker.fields.id') }}
                        </th>
                        <td>
                            {{ $worker->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.worker.fields.name') }}
                        </th>
                        <td>
                            {{ $worker->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.worker.fields.position') }}
                        </th>
                        <td>
                            {{ $worker->position->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.worker.fields.phone_number_1') }}
                        </th>
                        <td>
                            {{ $worker->phone_number_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.worker.fields.image') }}
                        </th>
                        <td>
                            @if($worker->image)
                                <a href="{{ $worker->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $worker->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.worker.fields.sallary') }}
                        </th>
                        <td>
                            {{ $worker->sallary }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.worker.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Worker::STATUS_SELECT[$worker->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.worker.fields.description') }}
                        </th>
                        <td>
                            {{ $worker->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.worker.fields.user') }}
                        </th>
                        <td>
                            {{ $worker->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.workers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection