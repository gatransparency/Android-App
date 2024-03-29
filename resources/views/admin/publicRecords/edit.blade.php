@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.publicRecord.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.public-records.update", [$publicRecord->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="request_number">{{ trans('cruds.publicRecord.fields.request_number') }}</label>
                <input class="form-control {{ $errors->has('request_number') ? 'is-invalid' : '' }}" type="text" name="request_number" id="request_number" value="{{ old('request_number', $publicRecord->request_number) }}" required>
                @if($errors->has('request_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('request_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicRecord.fields.request_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="agency">{{ trans('cruds.publicRecord.fields.agency') }}</label>
                <input class="form-control {{ $errors->has('agency') ? 'is-invalid' : '' }}" type="text" name="agency" id="agency" value="{{ old('agency', $publicRecord->agency) }}" required>
                @if($errors->has('agency'))
                    <div class="invalid-feedback">
                        {{ $errors->first('agency') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicRecord.fields.agency_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="response_due">{{ trans('cruds.publicRecord.fields.response_due') }}</label>
                <input class="form-control date {{ $errors->has('response_due') ? 'is-invalid' : '' }}" type="text" name="response_due" id="response_due" value="{{ old('response_due', $publicRecord->response_due) }}" required>
                @if($errors->has('response_due'))
                    <div class="invalid-feedback">
                        {{ $errors->first('response_due') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicRecord.fields.response_due_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="county">{{ trans('cruds.publicRecord.fields.county') }}</label>
                <input class="form-control {{ $errors->has('county') ? 'is-invalid' : '' }}" type="text" name="county" id="county" value="{{ old('county', $publicRecord->county) }}" required>
                @if($errors->has('county'))
                    <div class="invalid-feedback">
                        {{ $errors->first('county') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicRecord.fields.county_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="state">{{ trans('cruds.publicRecord.fields.state') }}</label>
                <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state" id="state" value="{{ old('state', $publicRecord->state) }}" required>
                @if($errors->has('state'))
                    <div class="invalid-feedback">
                        {{ $errors->first('state') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicRecord.fields.state_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="records_requested">{{ trans('cruds.publicRecord.fields.records_requested') }}</label>
                <textarea class="form-control {{ $errors->has('records_requested') ? 'is-invalid' : '' }}" name="records_requested" id="records_requested" required>{{ old('records_requested', $publicRecord->records_requested) }}</textarea>
                @if($errors->has('records_requested'))
                    <div class="invalid-feedback">
                        {{ $errors->first('records_requested') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicRecord.fields.records_requested_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.publicRecord.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PublicRecord::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $publicRecord->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicRecord.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="estimated_amount">{{ trans('cruds.publicRecord.fields.estimated_amount') }}</label>
                <input class="form-control {{ $errors->has('estimated_amount') ? 'is-invalid' : '' }}" type="number" name="estimated_amount" id="estimated_amount" value="{{ old('estimated_amount', $publicRecord->estimated_amount) }}" step="0.01">
                @if($errors->has('estimated_amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('estimated_amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicRecord.fields.estimated_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount_paid">{{ trans('cruds.publicRecord.fields.amount_paid') }}</label>
                <input class="form-control {{ $errors->has('amount_paid') ? 'is-invalid' : '' }}" type="number" name="amount_paid" id="amount_paid" value="{{ old('amount_paid', $publicRecord->amount_paid) }}" step="0.01">
                @if($errors->has('amount_paid'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount_paid') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicRecord.fields.amount_paid_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file">{{ trans('cruds.publicRecord.fields.file') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file') ? 'is-invalid' : '' }}" id="file-dropzone">
                </div>
                @if($errors->has('file'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicRecord.fields.file_helper') }}</span>
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
    url: '{{ route('admin.public-records.storeMedia') }}',
    maxFilesize: 25, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 25
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
@if(isset($publicRecord) && $publicRecord->file)
          var files =
            {!! json_encode($publicRecord->file) !!}
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