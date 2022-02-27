@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.student.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.students.update", [$student->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.student.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $student->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="birth_day">{{ trans('cruds.student.fields.birth_day') }}</label>
                <input class="form-control date {{ $errors->has('birth_day') ? 'is-invalid' : '' }}" type="text" name="birth_day" id="birth_day" value="{{ old('birth_day', $student->birth_day) }}">
                @if($errors->has('birth_day'))
                    <div class="invalid-feedback">
                        {{ $errors->first('birth_day') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.birth_day_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone_number">{{ trans('cruds.student.fields.phone_number') }}</label>
                <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $student->phone_number) }}">
                @if($errors->has('phone_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.phone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="groups">{{ trans('cruds.student.fields.groups') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('groups') ? 'is-invalid' : '' }}" name="groups[]" id="groups" multiple>
                    @foreach($groups as $id => $group)
                        <option value="{{ $id }}" {{ (in_array($id, old('groups', [])) || $student->groups->contains($id)) ? 'selected' : '' }}>{{ $group }}</option>
                    @endforeach
                </select>
                @if($errors->has('groups'))
                    <div class="invalid-feedback">
                        {{ $errors->first('groups') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.groups_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="image">{{ trans('cruds.student.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.student.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Student::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $student->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.student.fields.jinsi') }}</label>
                <select class="form-control {{ $errors->has('jinsi') ? 'is-invalid' : '' }}" name="jinsi" id="jinsi">
                    <option value disabled {{ old('jinsi', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Student::JINSI_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('jinsi', $student->jinsi) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('jinsi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jinsi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.jinsi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="weeks">{{ trans('cruds.student.fields.weeks') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('weeks') ? 'is-invalid' : '' }}" name="weeks[]" id="weeks" multiple>
                    @foreach($weeks as $id => $week)
                        <option value="{{ $id }}" {{ (in_array($id, old('weeks', [])) || $student->weeks->contains($id)) ? 'selected' : '' }}>{{ $week }}</option>
                    @endforeach
                </select>
                @if($errors->has('weeks'))
                    <div class="invalid-feedback">
                        {{ $errors->first('weeks') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.weeks_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="start_time">{{ trans('cruds.student.fields.start_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text" name="start_time" id="start_time" value="{{ old('start_time', $student->start_time) }}">
                @if($errors->has('start_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.start_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="end_time">{{ trans('cruds.student.fields.end_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('end_time') ? 'is-invalid' : '' }}" type="text" name="end_time" id="end_time" value="{{ old('end_time', $student->end_time) }}">
                @if($errors->has('end_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.end_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tuman_id">{{ trans('cruds.student.fields.tuman') }}</label>
                <select class="form-control select2 {{ $errors->has('tuman') ? 'is-invalid' : '' }}" name="tuman_id" id="tuman_id">
                    @foreach($tumen as $id => $entry)
                        <option value="{{ $id }}" {{ (old('tuman_id') ? old('tuman_id') : $student->tuman->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('tuman'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tuman') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.tuman_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.student.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $student->address) }}">
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reklama_id">{{ trans('cruds.student.fields.reklama') }}</label>
                <select class="form-control select2 {{ $errors->has('reklama') ? 'is-invalid' : '' }}" name="reklama_id" id="reklama_id">
                    @foreach($reklamas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('reklama_id') ? old('reklama_id') : $student->reklama->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('reklama'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reklama') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.reklama_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.student.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $student->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="filial_id">{{ trans('cruds.student.fields.filial') }}</label>
                <select class="form-control select2 {{ $errors->has('filial') ? 'is-invalid' : '' }}" name="filial_id" id="filial_id">
                    @foreach($filials as $id => $entry)
                        <option value="{{ $id }}" {{ (old('filial_id') ? old('filial_id') : $student->filial->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('filial'))
                    <div class="invalid-feedback">
                        {{ $errors->first('filial') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.filial_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.students.storeMedia') }}',
    maxFilesize: 3, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 3,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($student) && $student->image)
      var file = {!! json_encode($student->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection