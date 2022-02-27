@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.savolType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.savol-types.update", [$savolType->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.savolType.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $savolType->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.savolType.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sorovnoma_id">{{ trans('cruds.savolType.fields.sorovnoma') }}</label>
                <select class="form-control select2 {{ $errors->has('sorovnoma') ? 'is-invalid' : '' }}" name="sorovnoma_id" id="sorovnoma_id" required>
                    @foreach($sorovnomas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('sorovnoma_id') ? old('sorovnoma_id') : $savolType->sorovnoma->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('sorovnoma'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sorovnoma') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.savolType.fields.sorovnoma_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="filial_id">{{ trans('cruds.savolType.fields.filial') }}</label>
                <select class="form-control select2 {{ $errors->has('filial') ? 'is-invalid' : '' }}" name="filial_id" id="filial_id">
                    @foreach($filials as $id => $entry)
                        <option value="{{ $id }}" {{ (old('filial_id') ? old('filial_id') : $savolType->filial->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('filial'))
                    <div class="invalid-feedback">
                        {{ $errors->first('filial') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.savolType.fields.filial_helper') }}</span>
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