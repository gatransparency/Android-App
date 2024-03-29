@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.agenciesOffice.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.agencies-offices.update", [$agenciesOffice->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="image">{{ trans('cruds.agenciesOffice.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.agenciesOffice.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="agency_name">{{ trans('cruds.agenciesOffice.fields.agency_name') }}</label>
                <input class="form-control {{ $errors->has('agency_name') ? 'is-invalid' : '' }}" type="text" name="agency_name" id="agency_name" value="{{ old('agency_name', $agenciesOffice->agency_name) }}" required>
                @if($errors->has('agency_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('agency_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.agenciesOffice.fields.agency_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="street_address">{{ trans('cruds.agenciesOffice.fields.street_address') }}</label>
                <input class="form-control {{ $errors->has('street_address') ? 'is-invalid' : '' }}" type="text" name="street_address" id="street_address" value="{{ old('street_address', $agenciesOffice->street_address) }}" required>
                @if($errors->has('street_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('street_address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.agenciesOffice.fields.street_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="street_address_additional">{{ trans('cruds.agenciesOffice.fields.street_address_additional') }}</label>
                <input class="form-control {{ $errors->has('street_address_additional') ? 'is-invalid' : '' }}" type="text" name="street_address_additional" id="street_address_additional" value="{{ old('street_address_additional', $agenciesOffice->street_address_additional) }}">
                @if($errors->has('street_address_additional'))
                    <div class="invalid-feedback">
                        {{ $errors->first('street_address_additional') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.agenciesOffice.fields.street_address_additional_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="city">{{ trans('cruds.agenciesOffice.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $agenciesOffice->city) }}" required>
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.agenciesOffice.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="state">{{ trans('cruds.agenciesOffice.fields.state') }}</label>
                <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state" id="state" value="{{ old('state', $agenciesOffice->state) }}" required>
                @if($errors->has('state'))
                    <div class="invalid-feedback">
                        {{ $errors->first('state') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.agenciesOffice.fields.state_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="zip">{{ trans('cruds.agenciesOffice.fields.zip') }}</label>
                <input class="form-control {{ $errors->has('zip') ? 'is-invalid' : '' }}" type="text" name="zip" id="zip" value="{{ old('zip', $agenciesOffice->zip) }}" required>
                @if($errors->has('zip'))
                    <div class="invalid-feedback">
                        {{ $errors->first('zip') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.agenciesOffice.fields.zip_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="website_url">{{ trans('cruds.agenciesOffice.fields.website_url') }}</label>
                <input class="form-control {{ $errors->has('website_url') ? 'is-invalid' : '' }}" type="text" name="website_url" id="website_url" value="{{ old('website_url', $agenciesOffice->website_url) }}">
                @if($errors->has('website_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('website_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.agenciesOffice.fields.website_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone_number">{{ trans('cruds.agenciesOffice.fields.phone_number') }}</label>
                <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $agenciesOffice->phone_number) }}" required>
                @if($errors->has('phone_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.agenciesOffice.fields.phone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="agency_email">{{ trans('cruds.agenciesOffice.fields.agency_email') }}</label>
                <input class="form-control {{ $errors->has('agency_email') ? 'is-invalid' : '' }}" type="email" name="agency_email" id="agency_email" value="{{ old('agency_email', $agenciesOffice->agency_email) }}">
                @if($errors->has('agency_email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('agency_email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.agenciesOffice.fields.agency_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fax">{{ trans('cruds.agenciesOffice.fields.fax') }}</label>
                <input class="form-control {{ $errors->has('fax') ? 'is-invalid' : '' }}" type="text" name="fax" id="fax" value="{{ old('fax', $agenciesOffice->fax) }}">
                @if($errors->has('fax'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fax') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.agenciesOffice.fields.fax_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="agency_rating">{{ trans('cruds.agenciesOffice.fields.agency_rating') }}</label>
                <input class="form-control {{ $errors->has('agency_rating') ? 'is-invalid' : '' }}" type="text" name="agency_rating" id="agency_rating" value="{{ old('agency_rating', $agenciesOffice->agency_rating) }}">
                @if($errors->has('agency_rating'))
                    <div class="invalid-feedback">
                        {{ $errors->first('agency_rating') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.agenciesOffice.fields.agency_rating_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.agenciesOffice.fields.notes') }}</label>
                <textarea class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes">{{ old('notes', $agenciesOffice->notes) }}</textarea>
                @if($errors->has('notes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('notes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.agenciesOffice.fields.notes_helper') }}</span>
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
    url: '{{ route('admin.agencies-offices.storeMedia') }}',
    maxFilesize: 25, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
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
@if(isset($agenciesOffice) && $agenciesOffice->image)
      var file = {!! json_encode($agenciesOffice->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
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