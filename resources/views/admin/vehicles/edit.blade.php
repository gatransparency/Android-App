@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.vehicle.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.vehicles.update", [$vehicle->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="agency_id">{{ trans('cruds.vehicle.fields.agency') }}</label>
                <select class="form-control select2 {{ $errors->has('agency') ? 'is-invalid' : '' }}" name="agency_id" id="agency_id" required>
                    @foreach($agencies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('agency_id') ? old('agency_id') : $vehicle->agency->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('agency'))
                    <div class="invalid-feedback">
                        {{ $errors->first('agency') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vehicle.fields.agency_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="public_official_id">{{ trans('cruds.vehicle.fields.public_official') }}</label>
                <select class="form-control select2 {{ $errors->has('public_official') ? 'is-invalid' : '' }}" name="public_official_id" id="public_official_id">
                    @foreach($public_officials as $id => $entry)
                        <option value="{{ $id }}" {{ (old('public_official_id') ? old('public_official_id') : $vehicle->public_official->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('public_official'))
                    <div class="invalid-feedback">
                        {{ $errors->first('public_official') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vehicle.fields.public_official_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="image">{{ trans('cruds.vehicle.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vehicle.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="make">{{ trans('cruds.vehicle.fields.make') }}</label>
                <input class="form-control {{ $errors->has('make') ? 'is-invalid' : '' }}" type="text" name="make" id="make" value="{{ old('make', $vehicle->make) }}">
                @if($errors->has('make'))
                    <div class="invalid-feedback">
                        {{ $errors->first('make') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vehicle.fields.make_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="model">{{ trans('cruds.vehicle.fields.model') }}</label>
                <input class="form-control {{ $errors->has('model') ? 'is-invalid' : '' }}" type="text" name="model" id="model" value="{{ old('model', $vehicle->model) }}">
                @if($errors->has('model'))
                    <div class="invalid-feedback">
                        {{ $errors->first('model') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vehicle.fields.model_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="year">{{ trans('cruds.vehicle.fields.year') }}</label>
                <input class="form-control {{ $errors->has('year') ? 'is-invalid' : '' }}" type="text" name="year" id="year" value="{{ old('year', $vehicle->year) }}">
                @if($errors->has('year'))
                    <div class="invalid-feedback">
                        {{ $errors->first('year') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vehicle.fields.year_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="number">{{ trans('cruds.vehicle.fields.number') }}</label>
                <input class="form-control {{ $errors->has('number') ? 'is-invalid' : '' }}" type="text" name="number" id="number" value="{{ old('number', $vehicle->number) }}">
                @if($errors->has('number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vehicle.fields.number_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.vehicle.fields.marked') }}</label>
                <select class="form-control {{ $errors->has('marked') ? 'is-invalid' : '' }}" name="marked" id="marked">
                    <option value disabled {{ old('marked', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Vehicle::MARKED_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('marked', $vehicle->marked) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('marked'))
                    <div class="invalid-feedback">
                        {{ $errors->first('marked') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vehicle.fields.marked_helper') }}</span>
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
    var uploadedImageMap = {}
Dropzone.options.imageDropzone = {
    url: '{{ route('admin.vehicles.storeMedia') }}',
    maxFilesize: 50, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 50,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="image[]" value="' + response.name + '">')
      uploadedImageMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedImageMap[file.name]
      }
      $('form').find('input[name="image[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($vehicle) && $vehicle->image)
      var files = {!! json_encode($vehicle->image) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="image[]" value="' + file.file_name + '">')
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