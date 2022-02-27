@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.tolovlar.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tolovlars.update", [$tolovlar->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="group_id">{{ trans('cruds.tolovlar.fields.group') }}</label>
                <select class="form-control select2 {{ $errors->has('group') ? 'is-invalid' : '' }}" name="group_id" id="group_id" required>
                    @foreach($groups as $id => $entry)
                        <option value="{{ $id }}" {{ (old('group_id') ? old('group_id') : $tolovlar->group->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('group'))
                    <div class="invalid-feedback">
                        {{ $errors->first('group') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tolovlar.fields.group_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="student_id">{{ trans('cruds.tolovlar.fields.student') }}</label>
                <select class="form-control select2 {{ $errors->has('student') ? 'is-invalid' : '' }}" name="student_id" id="student_id" required>
                    @foreach($students as $id => $entry)
                        <option value="{{ $id }}" {{ (old('student_id') ? old('student_id') : $tolovlar->student->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('student'))
                    <div class="invalid-feedback">
                        {{ $errors->first('student') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tolovlar.fields.student_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="year">{{ trans('cruds.tolovlar.fields.year') }}</label>
                <input class="form-control {{ $errors->has('year') ? 'is-invalid' : '' }}" type="number" name="year" id="year" value="{{ old('year', $tolovlar->year) }}" step="1" required>
                @if($errors->has('year'))
                    <div class="invalid-feedback">
                        {{ $errors->first('year') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tolovlar.fields.year_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="month_id">{{ trans('cruds.tolovlar.fields.month') }}</label>
                <select class="form-control select2 {{ $errors->has('month') ? 'is-invalid' : '' }}" name="month_id" id="month_id" required>
                    @foreach($months as $id => $entry)
                        <option value="{{ $id }}" {{ (old('month_id') ? old('month_id') : $tolovlar->month->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('month'))
                    <div class="invalid-feedback">
                        {{ $errors->first('month') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tolovlar.fields.month_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.tolovlar.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Tolovlar::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $tolovlar->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tolovlar.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="summa">{{ trans('cruds.tolovlar.fields.summa') }}</label>
                <input class="form-control {{ $errors->has('summa') ? 'is-invalid' : '' }}" type="number" name="summa" id="summa" value="{{ old('summa', $tolovlar->summa) }}" step="0.01" required>
                @if($errors->has('summa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('summa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tolovlar.fields.summa_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="chegirma">{{ trans('cruds.tolovlar.fields.chegirma') }}</label>
                <input class="form-control {{ $errors->has('chegirma') ? 'is-invalid' : '' }}" type="number" name="chegirma" id="chegirma" value="{{ old('chegirma', $tolovlar->chegirma) }}" step="0.01" required>
                @if($errors->has('chegirma'))
                    <div class="invalid-feedback">
                        {{ $errors->first('chegirma') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tolovlar.fields.chegirma_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.tolovlar.fields.tolov_turi') }}</label>
                <select class="form-control {{ $errors->has('tolov_turi') ? 'is-invalid' : '' }}" name="tolov_turi" id="tolov_turi" required>
                    <option value disabled {{ old('tolov_turi', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Tolovlar::TOLOV_TURI_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('tolov_turi', $tolovlar->tolov_turi) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('tolov_turi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tolov_turi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tolovlar.fields.tolov_turi_helper') }}</span>
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