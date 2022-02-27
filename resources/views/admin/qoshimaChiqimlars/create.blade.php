@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.qoshimaChiqimlar.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.qoshima-chiqimlars.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="chiqim_sababi">{{ trans('cruds.qoshimaChiqimlar.fields.chiqim_sababi') }}</label>
                <textarea class="form-control {{ $errors->has('chiqim_sababi') ? 'is-invalid' : '' }}" name="chiqim_sababi" id="chiqim_sababi" required>{{ old('chiqim_sababi') }}</textarea>
                @if($errors->has('chiqim_sababi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('chiqim_sababi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.qoshimaChiqimlar.fields.chiqim_sababi_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="summa">{{ trans('cruds.qoshimaChiqimlar.fields.summa') }}</label>
                <input class="form-control {{ $errors->has('summa') ? 'is-invalid' : '' }}" type="number" name="summa" id="summa" value="{{ old('summa', '0') }}" step="0.01" required>
                @if($errors->has('summa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('summa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.qoshimaChiqimlar.fields.summa_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="kim_tarafidan_olindi_id">{{ trans('cruds.qoshimaChiqimlar.fields.kim_tarafidan_olindi') }}</label>
                <select class="form-control select2 {{ $errors->has('kim_tarafidan_olindi') ? 'is-invalid' : '' }}" name="kim_tarafidan_olindi_id" id="kim_tarafidan_olindi_id" required>
                    @foreach($kim_tarafidan_olindis as $id => $entry)
                        <option value="{{ $id }}" {{ old('kim_tarafidan_olindi_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('kim_tarafidan_olindi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kim_tarafidan_olindi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.qoshimaChiqimlar.fields.kim_tarafidan_olindi_helper') }}</span>
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