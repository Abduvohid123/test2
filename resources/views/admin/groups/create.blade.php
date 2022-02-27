@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.group.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.groups.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.group.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.group.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="room_id">{{ trans('cruds.group.fields.room') }}</label>
                <select class="form-control select2 {{ $errors->has('room') ? 'is-invalid' : '' }}" name="room_id" id="room_id" required>
                    @foreach($rooms as $id => $entry)
                        <option value="{{ $id }}" {{ old('room_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('room'))
                    <div class="invalid-feedback">
                        {{ $errors->first('room') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.group.fields.room_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fan_id">{{ trans('cruds.group.fields.fan') }}</label>
                <select class="form-control select2 {{ $errors->has('fan') ? 'is-invalid' : '' }}" name="fan_id" id="fan_id">
                    @foreach($fans as $id => $entry)
                        <option value="{{ $id }}" {{ old('fan_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('fan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.group.fields.fan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="cost">{{ trans('cruds.group.fields.cost') }}</label>
                <input class="form-control {{ $errors->has('cost') ? 'is-invalid' : '' }}" type="number" name="cost" id="cost" value="{{ old('cost', '0') }}" step="0.01" required>
                @if($errors->has('cost'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cost') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.group.fields.cost_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.group.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.group.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.group.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Group::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', 'zaxira') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.group.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="start">{{ trans('cruds.group.fields.start') }}</label>
                <input class="form-control timepicker {{ $errors->has('start') ? 'is-invalid' : '' }}" type="text" name="start" id="start" value="{{ old('start') }}">
                @if($errors->has('start'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.group.fields.start_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="finish">{{ trans('cruds.group.fields.finish') }}</label>
                <input class="form-control timepicker {{ $errors->has('finish') ? 'is-invalid' : '' }}" type="text" name="finish" id="finish" value="{{ old('finish') }}">
                @if($errors->has('finish'))
                    <div class="invalid-feedback">
                        {{ $errors->first('finish') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.group.fields.finish_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="days">{{ trans('cruds.group.fields.days') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('days') ? 'is-invalid' : '' }}" name="days[]" id="days" multiple>
                    @foreach($days as $id => $day)
                        <option value="{{ $id }}" {{ in_array($id, old('days', [])) ? 'selected' : '' }}>{{ $day }}</option>
                    @endforeach
                </select>
                @if($errors->has('days'))
                    <div class="invalid-feedback">
                        {{ $errors->first('days') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.group.fields.days_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="start_cource">{{ trans('cruds.group.fields.start_cource') }}</label>
                <input class="form-control date {{ $errors->has('start_cource') ? 'is-invalid' : '' }}" type="text" name="start_cource" id="start_cource" value="{{ old('start_cource') }}">
                @if($errors->has('start_cource'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_cource') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.group.fields.start_cource_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="filial_id">{{ trans('cruds.group.fields.filial') }}</label>
                <select class="form-control select2 {{ $errors->has('filial') ? 'is-invalid' : '' }}" name="filial_id" id="filial_id">
                    @foreach($filials as $id => $entry)
                        <option value="{{ $id }}" {{ old('filial_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('filial'))
                    <div class="invalid-feedback">
                        {{ $errors->first('filial') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.group.fields.filial_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection