@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.caseLaw.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.case-laws.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="docket_number">{{ trans('cruds.caseLaw.fields.docket_number') }}</label>
                <input class="form-control {{ $errors->has('docket_number') ? 'is-invalid' : '' }}" type="text" name="docket_number" id="docket_number" value="{{ old('docket_number', '') }}" required>
                @if($errors->has('docket_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('docket_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.caseLaw.fields.docket_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="court">{{ trans('cruds.caseLaw.fields.court') }}</label>
                <input class="form-control {{ $errors->has('court') ? 'is-invalid' : '' }}" type="text" name="court" id="court" value="{{ old('court', '') }}" required>
                @if($errors->has('court'))
                    <div class="invalid-feedback">
                        {{ $errors->first('court') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.caseLaw.fields.court_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="case">{{ trans('cruds.caseLaw.fields.case') }}</label>
                <input class="form-control {{ $errors->has('case') ? 'is-invalid' : '' }}" type="text" name="case" id="case" value="{{ old('case', '') }}" required>
                @if($errors->has('case'))
                    <div class="invalid-feedback">
                        {{ $errors->first('case') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.caseLaw.fields.case_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="decided">{{ trans('cruds.caseLaw.fields.decided') }}</label>
                <input class="form-control date {{ $errors->has('decided') ? 'is-invalid' : '' }}" type="text" name="decided" id="decided" value="{{ old('decided') }}" required>
                @if($errors->has('decided'))
                    <div class="invalid-feedback">
                        {{ $errors->first('decided') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.caseLaw.fields.decided_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="case_narrative">{{ trans('cruds.caseLaw.fields.case_narrative') }}</label>
                <textarea class="form-control {{ $errors->has('case_narrative') ? 'is-invalid' : '' }}" name="case_narrative" id="case_narrative" required>{{ old('case_narrative') }}</textarea>
                @if($errors->has('case_narrative'))
                    <div class="invalid-feedback">
                        {{ $errors->first('case_narrative') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.caseLaw.fields.case_narrative_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="judge">{{ trans('cruds.caseLaw.fields.judge') }}</label>
                <input class="form-control {{ $errors->has('judge') ? 'is-invalid' : '' }}" type="text" name="judge" id="judge" value="{{ old('judge', '') }}" required>
                @if($errors->has('judge'))
                    <div class="invalid-feedback">
                        {{ $errors->first('judge') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.caseLaw.fields.judge_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="case_file">{{ trans('cruds.caseLaw.fields.case_file') }}</label>
                <div class="needsclick dropzone {{ $errors->has('case_file') ? 'is-invalid' : '' }}" id="case_file-dropzone">
                </div>
                @if($errors->has('case_file'))
                    <div class="invalid-feedback">
                        {{ $errors->first('case_file') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.caseLaw.fields.case_file_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="added_by">{{ trans('cruds.caseLaw.fields.added_by') }}</label>
                <input class="form-control {{ $errors->has('added_by') ? 'is-invalid' : '' }}" type="text" name="added_by" id="added_by" value="{{ old('added_by', '') }}" required>
                @if($errors->has('added_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('added_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.caseLaw.fields.added_by_helper') }}</span>
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
    var uploadedCaseFileMap = {}
Dropzone.options.caseFileDropzone = {
    url: '{{ route('admin.case-laws.storeMedia') }}',
    maxFilesize: 50, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 50
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="case_file[]" value="' + response.name + '">')
      uploadedCaseFileMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedCaseFileMap[file.name]
      }
      $('form').find('input[name="case_file[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($caseLaw) && $caseLaw->case_file)
          var files =
            {!! json_encode($caseLaw->case_file) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="case_file[]" value="' + file.file_name + '">')
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