@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.fan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.fans.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.fan.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fan.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price">{{ trans('cruds.fan.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" step="1" required>
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fan.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="filial_id">{{ trans('cruds.fan.fields.filial') }}</label>
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
                <span class="help-block">{{ trans('cruds.fan.fields.filial_helper') }}</span>
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