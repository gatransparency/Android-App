@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.internalInvestigation.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.internal-investigations.update", [$internalInvestigation->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="agency_id">{{ trans('cruds.internalInvestigation.fields.agency') }}</label>
                <select class="form-control select2 {{ $errors->has('agency') ? 'is-invalid' : '' }}" name="agency_id" id="agency_id" required>
                    @foreach($agencies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('agency_id') ? old('agency_id') : $internalInvestigation->agency->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('agency'))
                    <div class="invalid-feedback">
                        {{ $errors->first('agency') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.internalInvestigation.fields.agency_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="public_official_id">{{ trans('cruds.internalInvestigation.fields.public_official') }}</label>
                <select class="form-control select2 {{ $errors->has('public_official') ? 'is-invalid' : '' }}" name="public_official_id" id="public_official_id" required>
                    @foreach($public_officials as $id => $entry)
                        <option value="{{ $id }}" {{ (old('public_official_id') ? old('public_official_id') : $internalInvestigation->public_official->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('public_official'))
                    <div class="invalid-feedback">
                        {{ $errors->first('public_official') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.internalInvestigation.fields.public_official_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="narrative">{{ trans('cruds.internalInvestigation.fields.narrative') }}</label>
                <textarea class="form-control {{ $errors->has('narrative') ? 'is-invalid' : '' }}" name="narrative" id="narrative" required>{{ old('narrative', $internalInvestigation->narrative) }}</textarea>
                @if($errors->has('narrative'))
                    <div class="invalid-feedback">
                        {{ $errors->first('narrative') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.internalInvestigation.fields.narrative_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file">{{ trans('cruds.internalInvestigation.fields.file') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file') ? 'is-invalid' : '' }}" id="file-dropzone">
                </div>
                @if($errors->has('file'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.internalInvestigation.fields.file_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.internalInvestigation.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\InternalInvestigation::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $internalInvestigation->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.internalInvestigation.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="entered_by_id">{{ trans('cruds.internalInvestigation.fields.entered_by') }}</label>
                <select class="form-control select2 {{ $errors->has('entered_by') ? 'is-invalid' : '' }}" name="entered_by_id" id="entered_by_id" required>
                    @foreach($entered_bies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('entered_by_id') ? old('entered_by_id') : $internalInvestigation->entered_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('entered_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('entered_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.internalInvestigation.fields.entered_by_helper') }}</span>
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
    var uploadedFileMap = {}
Dropzone.options.fileDropzone = {
    url: '{{ route('admin.internal-investigations.storeMedia') }}',
    maxFilesize: 150, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 150
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="file[]" value="' + response.name + '">')
      uploadedFileMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFileMap[file.name]
      }
      $('form').find('input[name="file[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($internalInvestigation) && $internalInvestigation->file)
          var files =
            {!! json_encode($internalInvestigation->file) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="file[]" value="' + file.file_name + '">')
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