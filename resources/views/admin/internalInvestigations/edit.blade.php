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
                <label class="required" for="ia_date">{{ trans('cruds.internalInvestigation.fields.ia_date') }}</label>
                <input class="form-control date {{ $errors->has('ia_date') ? 'is-invalid' : '' }}" type="text" name="ia_date" id="ia_date" value="{{ old('ia_date', $internalInvestigation->ia_date) }}" required>
                @if($errors->has('ia_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ia_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.internalInvestigation.fields.ia_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="gtnn_number_id">{{ trans('cruds.internalInvestigation.fields.gtnn_number') }}</label>
                <select class="form-control select2 {{ $errors->has('gtnn_number') ? 'is-invalid' : '' }}" name="gtnn_number_id" id="gtnn_number_id" required>
                    @foreach($gtnn_numbers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('gtnn_number_id') ? old('gtnn_number_id') : $internalInvestigation->gtnn_number->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('gtnn_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gtnn_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.internalInvestigation.fields.gtnn_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="agency_office_id">{{ trans('cruds.internalInvestigation.fields.agency_office') }}</label>
                <select class="form-control select2 {{ $errors->has('agency_office') ? 'is-invalid' : '' }}" name="agency_office_id" id="agency_office_id" required>
                    @foreach($agency_offices as $id => $entry)
                        <option value="{{ $id }}" {{ (old('agency_office_id') ? old('agency_office_id') : $internalInvestigation->agency_office->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('agency_office'))
                    <div class="invalid-feedback">
                        {{ $errors->first('agency_office') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.internalInvestigation.fields.agency_office_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.internalInvestigation.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $internalInvestigation->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.internalInvestigation.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="investigator">{{ trans('cruds.internalInvestigation.fields.investigator') }}</label>
                <input class="form-control {{ $errors->has('investigator') ? 'is-invalid' : '' }}" type="text" name="investigator" id="investigator" value="{{ old('investigator', $internalInvestigation->investigator) }}" required>
                @if($errors->has('investigator'))
                    <div class="invalid-feedback">
                        {{ $errors->first('investigator') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.internalInvestigation.fields.investigator_helper') }}</span>
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
                <label for="files">{{ trans('cruds.internalInvestigation.fields.files') }}</label>
                <div class="needsclick dropzone {{ $errors->has('files') ? 'is-invalid' : '' }}" id="files-dropzone">
                </div>
                @if($errors->has('files'))
                    <div class="invalid-feedback">
                        {{ $errors->first('files') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.internalInvestigation.fields.files_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="entered_by">{{ trans('cruds.internalInvestigation.fields.entered_by') }}</label>
                <input class="form-control {{ $errors->has('entered_by') ? 'is-invalid' : '' }}" type="text" name="entered_by" id="entered_by" value="{{ old('entered_by', $internalInvestigation->entered_by) }}" required>
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
    var uploadedFilesMap = {}
Dropzone.options.filesDropzone = {
    url: '{{ route('admin.internal-investigations.storeMedia') }}',
    maxFilesize: 25, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 25
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="files[]" value="' + response.name + '">')
      uploadedFilesMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFilesMap[file.name]
      }
      $('form').find('input[name="files[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($internalInvestigation) && $internalInvestigation->files)
          var files =
            {!! json_encode($internalInvestigation->files) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="files[]" value="' + file.file_name + '">')
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