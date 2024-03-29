@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.vehicle.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.vehicles.store") }}" enctype="multipart/form-data">
            @csrf
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
                <label class="required" for="gtnn_number_id">{{ trans('cruds.vehicle.fields.gtnn_number') }}</label>
                <select class="form-control select2 {{ $errors->has('gtnn_number') ? 'is-invalid' : '' }}" name="gtnn_number_id" id="gtnn_number_id" required>
                    @foreach($gtnn_numbers as $id => $entry)
                        <option value="{{ $id }}" {{ old('gtnn_number_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('gtnn_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gtnn_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vehicle.fields.gtnn_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="agency_vehicle_id">{{ trans('cruds.vehicle.fields.agency_vehicle') }}</label>
                <select class="form-control select2 {{ $errors->has('agency_vehicle') ? 'is-invalid' : '' }}" name="agency_vehicle_id" id="agency_vehicle_id" required>
                    @foreach($agency_vehicles as $id => $entry)
                        <option value="{{ $id }}" {{ old('agency_vehicle_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('agency_vehicle'))
                    <div class="invalid-feedback">
                        {{ $errors->first('agency_vehicle') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vehicle.fields.agency_vehicle_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="year">{{ trans('cruds.vehicle.fields.year') }}</label>
                <input class="form-control {{ $errors->has('year') ? 'is-invalid' : '' }}" type="text" name="year" id="year" value="{{ old('year', '') }}" required>
                @if($errors->has('year'))
                    <div class="invalid-feedback">
                        {{ $errors->first('year') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vehicle.fields.year_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="make">{{ trans('cruds.vehicle.fields.make') }}</label>
                <input class="form-control {{ $errors->has('make') ? 'is-invalid' : '' }}" type="text" name="make" id="make" value="{{ old('make', '') }}" required>
                @if($errors->has('make'))
                    <div class="invalid-feedback">
                        {{ $errors->first('make') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vehicle.fields.make_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="model">{{ trans('cruds.vehicle.fields.model') }}</label>
                <input class="form-control {{ $errors->has('model') ? 'is-invalid' : '' }}" type="text" name="model" id="model" value="{{ old('model', '') }}" required>
                @if($errors->has('model'))
                    <div class="invalid-feedback">
                        {{ $errors->first('model') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vehicle.fields.model_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.vehicle.fields.marked') }}</label>
                <select class="form-control {{ $errors->has('marked') ? 'is-invalid' : '' }}" name="marked" id="marked" required>
                    <option value disabled {{ old('marked', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Vehicle::MARKED_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('marked', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
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
                <label class="required">{{ trans('cruds.vehicle.fields.style') }}</label>
                <select class="form-control {{ $errors->has('style') ? 'is-invalid' : '' }}" name="style" id="style" required>
                    <option value disabled {{ old('style', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Vehicle::STYLE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('style', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('style'))
                    <div class="invalid-feedback">
                        {{ $errors->first('style') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vehicle.fields.style_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.vehicle.fields.condition') }}</label>
                <select class="form-control {{ $errors->has('condition') ? 'is-invalid' : '' }}" name="condition" id="condition" required>
                    <option value disabled {{ old('condition', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Vehicle::CONDITION_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('condition', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('condition'))
                    <div class="invalid-feedback">
                        {{ $errors->first('condition') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vehicle.fields.condition_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="plate_number">{{ trans('cruds.vehicle.fields.plate_number') }}</label>
                <input class="form-control {{ $errors->has('plate_number') ? 'is-invalid' : '' }}" type="text" name="plate_number" id="plate_number" value="{{ old('plate_number', '') }}">
                @if($errors->has('plate_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('plate_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vehicle.fields.plate_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="vehicle_number">{{ trans('cruds.vehicle.fields.vehicle_number') }}</label>
                <input class="form-control {{ $errors->has('vehicle_number') ? 'is-invalid' : '' }}" type="text" name="vehicle_number" id="vehicle_number" value="{{ old('vehicle_number', '') }}">
                @if($errors->has('vehicle_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('vehicle_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vehicle.fields.vehicle_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.vehicle.fields.notes') }}</label>
                <textarea class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes">{{ old('notes') }}</textarea>
                @if($errors->has('notes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('notes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vehicle.fields.notes_helper') }}</span>
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
    maxFilesize: 25, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 25,
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