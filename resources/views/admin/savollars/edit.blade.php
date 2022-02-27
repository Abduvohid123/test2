@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.savollar.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.savollars.update", [$savollar->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="savol">{{ trans('cruds.savollar.fields.savol') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('savol') ? 'is-invalid' : '' }}" name="savol" id="savol">{!! old('savol', $savollar->savol) !!}</textarea>
                @if($errors->has('savol'))
                    <div class="invalid-feedback">
                        {{ $errors->first('savol') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.savollar.fields.savol_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="savol_title">{{ trans('cruds.savollar.fields.savol_title') }}</label>
                <textarea class="form-control {{ $errors->has('savol_title') ? 'is-invalid' : '' }}" name="savol_title" id="savol_title" required>{{ old('savol_title', $savollar->savol_title) }}</textarea>
                @if($errors->has('savol_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('savol_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.savollar.fields.savol_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="savol_type_id">{{ trans('cruds.savollar.fields.savol_type') }}</label>
                <select class="form-control select2 {{ $errors->has('savol_type') ? 'is-invalid' : '' }}" name="savol_type_id" id="savol_type_id" required>
                    @foreach($savol_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('savol_type_id') ? old('savol_type_id') : $savollar->savol_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('savol_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('savol_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.savollar.fields.savol_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="filial_id">{{ trans('cruds.savollar.fields.filial') }}</label>
                <select class="form-control select2 {{ $errors->has('filial') ? 'is-invalid' : '' }}" name="filial_id" id="filial_id">
                    @foreach($filials as $id => $entry)
                        <option value="{{ $id }}" {{ (old('filial_id') ? old('filial_id') : $savollar->filial->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('filial'))
                    <div class="invalid-feedback">
                        {{ $errors->first('filial') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.savollar.fields.filial_helper') }}</span>
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
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.savollars.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $savollar->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection