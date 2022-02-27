@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.group.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.groups.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.id') }}
                        </th>
                        <td>
                            {{ $group->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.name') }}
                        </th>
                        <td>
                            {{ $group->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.room') }}
                        </th>
                        <td>
                            {{ $group->room->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.fan') }}
                        </th>
                        <td>
                            {{ $group->fan->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.cost') }}
                        </th>
                        <td>
                            {{ $group->cost }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.description') }}
                        </th>
                        <td>
                            {{ $group->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Group::STATUS_SELECT[$group->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.start') }}
                        </th>
                        <td>
                            {{ $group->start }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.finish') }}
                        </th>
                        <td>
                            {{ $group->finish }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.days') }}
                        </th>
                        <td>
                            @foreach($group->days as $key => $days)
                                <span class="label label-info">{{ $days->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.start_cource') }}
                        </th>
                        <td>
                            {{ $group->start_cource }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.groups.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection