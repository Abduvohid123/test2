@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.kashalok.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.kashaloks.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.kashalok.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kashalok.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="summa">{{ trans('cruds.kashalok.fields.summa') }}</label>
                <input class="form-control {{ $errors->has('summa') ? 'is-invalid' : '' }}" type="number" name="summa" id="summa" value="{{ old('summa', '0') }}" step="0.01" required>
                @if($errors->has('summa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('summa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kashalok.fields.summa_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.kashalok.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Kashalok::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kashalok.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="filial_id">{{ trans('cruds.kashalok.fields.filial') }}</label>
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
                <span class="help-block">{{ trans('cruds.kashalok.fields.filial_helper') }}</span>
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