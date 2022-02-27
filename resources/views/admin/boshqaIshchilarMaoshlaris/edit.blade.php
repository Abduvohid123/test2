@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.boshqaIshchilarMaoshlari.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.boshqa-ishchilar-maoshlaris.update", [$boshqaIshchilarMaoshlari->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="worker_id">{{ trans('cruds.boshqaIshchilarMaoshlari.fields.worker') }}</label>
                <select class="form-control select2 {{ $errors->has('worker') ? 'is-invalid' : '' }}" name="worker_id" id="worker_id" required>
                    @foreach($workers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('worker_id') ? old('worker_id') : $boshqaIshchilarMaoshlari->worker->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <input class="form-control {{ $errors->has('summa') ? 'is-invalid' : '' }}" type="number" name="summa" id="summa" value="{{ old('summa', $boshqaIshchilarMaoshlari->summa) }}" step="0.01" required>
                @if($errors->has('summa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('summa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.boshqaIshchilarMaoshlari.fields.summa_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="bonus">{{ trans('cruds.boshqaIshchilarMaoshlari.fields.bonus') }}</label>
                <input class="form-control {{ $errors->has('bonus') ? 'is-invalid' : '' }}" type="number" name="bonus" id="bonus" value="{{ old('bonus', $boshqaIshchilarMaoshlari->bonus) }}" step="0.01" required>
                @if($errors->has('bonus'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bonus') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.boshqaIshchilarMaoshlari.fields.bonus_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="jarima">{{ trans('cruds.boshqaIshchilarMaoshlari.fields.jarima') }}</label>
                <input class="form-control {{ $errors->has('jarima') ? 'is-invalid' : '' }}" type="number" name="jarima" id="jarima" value="{{ old('jarima', $boshqaIshchilarMaoshlari->jarima) }}" step="0.01" required>
                @if($errors->has('jarima'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jarima') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.boshqaIshchilarMaoshlari.fields.jarima_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="filial_id">{{ trans('cruds.boshqaIshchilarMaoshlari.fields.filial') }}</label>
                <select class="form-control select2 {{ $errors->has('filial') ? 'is-invalid' : '' }}" name="filial_id" id="filial_id">
                    @foreach($filials as $id => $entry)
                        <option value="{{ $id }}" {{ (old('filial_id') ? old('filial_id') : $boshqaIshchilarMaoshlari->filial->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('filial'))
                    <div class="invalid-feedback">
                        {{ $errors->first('filial') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.boshqaIshchilarMaoshlari.fields.filial_helper') }}</span>
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