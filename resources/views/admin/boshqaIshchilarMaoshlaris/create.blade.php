@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.boshqaIshchilarMaoshlari.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.boshqa-ishchilar-maoshlaris.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="worker_id">{{ trans('cruds.boshqaIshchilarMaoshlari.fields.worker') }}</label>
                <select class="form-control select2 {{ $errors->has('worker') ? 'is-invalid' : '' }}" name="worker_id" id="worker_id" required>
                    @foreach($workers as $id => $entry)
                        <option value="{{ $id }}" {{ old('worker_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('worker'))
                    <div class="invalid-feedback">
                        {{ $errors->first('worker') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.boshqaIshchilarMaoshlari.fields.worker_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="summa">{{ trans('cruds.boshqaIshchilarMaoshlari.fields.summa') }}</label>
                <input class="form-control {{ $errors->has('summa') ? 'is-invalid' : '' }}" type="number" name="summa" id="summa" value="{{ old('summa', '') }}" step="0.01" required>
                @if($errors->has('summa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('summa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.boshqaIshchilarMaoshlari.fields.summa_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="bonus">{{ trans('cruds.boshqaIshchilarMaoshlari.fields.bonus') }}</label>
                <input class="form-control {{ $errors->has('bonus') ? 'is-invalid' : '' }}" type="number" name="bonus" id="bonus" value="{{ old('bonus', '0') }}" step="0.01" required>
                @if($errors->has('bonus'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bonus') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.boshqaIshchilarMaoshlari.fields.bonus_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="jarima">{{ trans('cruds.boshqaIshchilarMaoshlari.fields.jarima') }}</label>
                <input class="form-control {{ $errors->has('jarima') ? 'is-invalid' : '' }}" type="number" name="jarima" id="jarima" value="{{ old('jarima', '0') }}" step="0.01" required>
                @if($errors->has('jarima'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jarima') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.boshqaIshchilarMaoshlari.fields.jarima_helper') }}</span>
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