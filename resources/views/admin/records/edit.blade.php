@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.record.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.records.update", [$record->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="full_name">{{ trans('cruds.record.fields.full_name') }}</label>
                <input class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" type="text" name="full_name" id="full_name" value="{{ old('full_name', $record->full_name) }}" required>
                @if($errors->has('full_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('full_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.record.fields.full_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="record_type">{{ trans('cruds.record.fields.record_type') }}</label>
                <input class="form-control {{ $errors->has('record_type') ? 'is-invalid' : '' }}" type="text" name="record_type" id="record_type" value="{{ old('record_type', $record->record_type) }}" required>
                @if($errors->has('record_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('record_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.record.fields.record_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="record">{{ trans('cruds.record.fields.record') }}</label>
                <div class="needsclick dropzone {{ $errors->has('record') ? 'is-invalid' : '' }}" id="record-dropzone">
                </div>
                @if($errors->has('record'))
                    <div class="invalid-feedback">
                        {{ $errors->first('record') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.record.fields.record_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="entered_by">{{ trans('cruds.record.fields.entered_by') }}</label>
                <input class="form-control {{ $errors->has('entered_by') ? 'is-invalid' : '' }}" type="text" name="entered_by" id="entered_by" value="{{ old('entered_by', $record->entered_by) }}" required>
                @if($errors->has('entered_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('entered_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.record.fields.entered_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="gtnn_number_id">{{ trans('cruds.record.fields.gtnn_number') }}</label>
                <select class="form-control select2 {{ $errors->has('gtnn_number') ? 'is-invalid' : '' }}" name="gtnn_number_id" id="gtnn_number_id" required>
                    @foreach($gtnn_numbers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('gtnn_number_id') ? old('gtnn_number_id') : $record->gtnn_number->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('gtnn_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gtnn_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.record.fields.gtnn_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="agency_id">{{ trans('cruds.record.fields.agency') }}</label>
                <select class="form-control select2 {{ $errors->has('agency') ? 'is-invalid' : '' }}" name="agency_id" id="agency_id" required>
                    @foreach($agencies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('agency_id') ? old('agency_id') : $record->agency->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('agency'))
                    <div class="invalid-feedback">
                        {{ $errors->first('agency') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.record.fields.agency_helper') }}</span>
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
    var uploadedRecordMap = {}
Dropzone.options.recordDropzone = {
    url: '{{ route('admin.records.storeMedia') }}',
    maxFilesize: 150, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 150
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="record[]" value="' + response.name + '">')
      uploadedRecordMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedRecordMap[file.name]
      }
      $('form').find('input[name="record[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($record) && $record->record)
          var files =
            {!! json_encode($record->record) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="record[]" value="' + file.file_name + '">')
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