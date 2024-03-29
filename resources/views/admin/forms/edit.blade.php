@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.form.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.forms.update", [$form->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="form_number">{{ trans('cruds.form.fields.form_number') }}</label>
                <input class="form-control {{ $errors->has('form_number') ? 'is-invalid' : '' }}" type="text" name="form_number" id="form_number" value="{{ old('form_number', $form->form_number) }}" required>
                @if($errors->has('form_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('form_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.form.fields.form_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="form_name">{{ trans('cruds.form.fields.form_name') }}</label>
                <input class="form-control {{ $errors->has('form_name') ? 'is-invalid' : '' }}" type="text" name="form_name" id="form_name" value="{{ old('form_name', $form->form_name) }}" required>
                @if($errors->has('form_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('form_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.form.fields.form_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.form.fields.form_format') }}</label>
                <select class="form-control {{ $errors->has('form_format') ? 'is-invalid' : '' }}" name="form_format" id="form_format" required>
                    <option value disabled {{ old('form_format', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Form::FORM_FORMAT_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('form_format', $form->form_format) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('form_format'))
                    <div class="invalid-feedback">
                        {{ $errors->first('form_format') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.form.fields.form_format_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="form">{{ trans('cruds.form.fields.form') }}</label>
                <div class="needsclick dropzone {{ $errors->has('form') ? 'is-invalid' : '' }}" id="form-dropzone">
                </div>
                @if($errors->has('form'))
                    <div class="invalid-feedback">
                        {{ $errors->first('form') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.form.fields.form_helper') }}</span>
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
    var uploadedFormMap = {}
Dropzone.options.formDropzone = {
    url: '{{ route('admin.forms.storeMedia') }}',
    maxFilesize: 50, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 50
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="form[]" value="' + response.name + '">')
      uploadedFormMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFormMap[file.name]
      }
      $('form').find('input[name="form[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($form) && $form->form)
          var files =
            {!! json_encode($form->form) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="form[]" value="' + file.file_name + '">')
            }
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