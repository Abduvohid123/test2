@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.addTeacheToGroup.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.add-teache-to-groups.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.addTeacheToGroup.fields.id') }}
                        </th>
                        <td>
                            {{ $addTeacheToGroup->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addTeacheToGroup.fields.group') }}
                        </th>
                        <td>
                            {{ $addTeacheToGroup->group->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addTeacheToGroup.fields.teacher') }}
                        </th>
                        <td>
                            @foreach($addTeacheToGroup->teachers as $key => $teacher)
                                <span class="label label-info">{{ $teacher->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addTeacheToGroup.fields.sallary_type') }}
                        </th>
                        <td>
                            {{ App\Models\AddTeacheToGroup::SALLARY_TYPE_RADIO[$addTeacheToGroup->sallary_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addTeacheToGroup.fields.oylik') }}
                        </th>
                        <td>
                            {{ $addTeacheToGroup->oylik }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.add-teache-to-groups.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection