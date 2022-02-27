@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.tumanlar.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tumanlars.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.tumanlar.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tumanlar.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="viloyat_id">{{ trans('cruds.tumanlar.fields.viloyat') }}</label>
                <select class="form-control select2 {{ $errors->has('viloyat') ? 'is-invalid' : '' }}" name="viloyat_id" id="viloyat_id">
                    @foreach($viloyats as $id => $entry)
                        <option value="{{ $id }}" {{ old('viloyat_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('viloyat'))
                    <div class="invalid-feedback">
                        {{ $errors->first('viloyat') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tumanlar.fields.viloyat_helper') }}</span>
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