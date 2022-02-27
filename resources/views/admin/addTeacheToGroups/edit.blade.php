@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.addTeacheToGroup.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.add-teache-to-groups.update", [$addTeacheToGroup->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="group_id">{{ trans('cruds.addTeacheToGroup.fields.group') }}</label>
                <select class="form-control select2 {{ $errors->has('group') ? 'is-invalid' : '' }}" name="group_id" id="group_id">
                    @foreach($groups as $id => $entry)
                        <option value="{{ $id }}" {{ (old('group_id') ? old('group_id') : $addTeacheToGroup->group->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('group'))
                    <div class="invalid-feedback">
                        {{ $errors->first('group') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.addTeacheToGroup.fields.group_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="teachers">{{ trans('cruds.addTeacheToGroup.fields.teacher') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('teachers') ? 'is-invalid' : '' }}" name="teachers[]" id="teachers" multiple required>
                    @foreach($teachers as $id => $teacher)
                        <option value="{{ $id }}" {{ (in_array($id, old('teachers', [])) || $addTeacheToGroup->teachers->contains($id)) ? 'selected' : '' }}>{{ $teacher }}</option>
                    @endforeach
                </select>
                @if($errors->has('teachers'))
                    <div class="invalid-feedback">
                        {{ $errors->first('teachers') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.addTeacheToGroup.fields.teacher_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.addTeacheToGroup.fields.sallary_type') }}</label>
                @foreach(App\Models\AddTeacheToGroup::SALLARY_TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('sallary_type') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="sallary_type_{{ $key }}" name="sallary_type" value="{{ $key }}" {{ old('sallary_type', $addTeacheToGroup->sallary_type) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="sallary_type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('sallary_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sallary_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.addTeacheToGroup.fields.sallary_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="oylik">{{ trans('cruds.addTeacheToGroup.fields.oylik') }}</label>
                <input class="form-control {{ $errors->has('oylik') ? 'is-invalid' : '' }}" type="number" name="oylik" id="oylik" value="{{ old('oylik', $addTeacheToGroup->oylik) }}" step="0.01" required>
                @if($errors->has('oylik'))
                    <div class="invalid-feedback">
                        {{ $errors->first('oylik') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.addTeacheToGroup.fields.oylik_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="filial_id">{{ trans('cruds.addTeacheToGroup.fields.filial') }}</label>
                <select class="form-control select2 {{ $errors->has('filial') ? 'is-invalid' : '' }}" name="filial_id" id="filial_id">
                    @foreach($filials as $id => $entry)
                        <option value="{{ $id }}" {{ (old('filial_id') ? old('filial_id') : $addTeacheToGroup->filial->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('filial'))
                    <div class="invalid-feedback">
                        {{ $errors->first('filial') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.addTeacheToGroup.fields.filial_helper') }}</span>
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