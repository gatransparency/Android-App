@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.publicOfficial.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.public-officials.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">{{ trans('cruds.publicOfficial.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="agency_id">{{ trans('cruds.publicOfficial.fields.agency') }}</label>
                <select class="form-control select2 {{ $errors->has('agency') ? 'is-invalid' : '' }}" name="agency_id" id="agency_id" required>
                    @foreach($agencies as $id => $entry)
                        <option value="{{ $id }}" {{ old('agency_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('agency'))
                    <div class="invalid-feedback">
                        {{ $errors->first('agency') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.agency_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="public_official_number">{{ trans('cruds.publicOfficial.fields.public_official_number') }}</label>
                <input class="form-control {{ $errors->has('public_official_number') ? 'is-invalid' : '' }}" type="text" name="public_official_number" id="public_official_number" value="{{ old('public_official_number', '') }}" required>
                @if($errors->has('public_official_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('public_official_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.public_official_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="first_name">{{ trans('cruds.publicOfficial.fields.first_name') }}</label>
                <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', '') }}" required>
                @if($errors->has('first_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('first_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="middle_name">{{ trans('cruds.publicOfficial.fields.middle_name') }}</label>
                <input class="form-control {{ $errors->has('middle_name') ? 'is-invalid' : '' }}" type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', '') }}">
                @if($errors->has('middle_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('middle_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.middle_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="last_name">{{ trans('cruds.publicOfficial.fields.last_name') }}</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', '') }}" required>
                @if($errors->has('last_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.last_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="badge_employee_number">{{ trans('cruds.publicOfficial.fields.badge_employee_number') }}</label>
                <input class="form-control {{ $errors->has('badge_employee_number') ? 'is-invalid' : '' }}" type="text" name="badge_employee_number" id="badge_employee_number" value="{{ old('badge_employee_number', '') }}">
                @if($errors->has('badge_employee_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('badge_employee_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.badge_employee_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sex">{{ trans('cruds.publicOfficial.fields.sex') }}</label>
                <input class="form-control {{ $errors->has('sex') ? 'is-invalid' : '' }}" type="text" name="sex" id="sex" value="{{ old('sex', '') }}">
                @if($errors->has('sex'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sex') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.sex_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="rank">{{ trans('cruds.publicOfficial.fields.rank') }}</label>
                <input class="form-control {{ $errors->has('rank') ? 'is-invalid' : '' }}" type="text" name="rank" id="rank" value="{{ old('rank', '') }}">
                @if($errors->has('rank'))
                    <div class="invalid-feedback">
                        {{ $errors->first('rank') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.rank_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.publicOfficial.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PublicOfficial::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="officer_key_number">{{ trans('cruds.publicOfficial.fields.officer_key_number') }}</label>
                <input class="form-control {{ $errors->has('officer_key_number') ? 'is-invalid' : '' }}" type="text" name="officer_key_number" id="officer_key_number" value="{{ old('officer_key_number', '') }}">
                @if($errors->has('officer_key_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('officer_key_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.officer_key_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hired">{{ trans('cruds.publicOfficial.fields.hired') }}</label>
                <input class="form-control date {{ $errors->has('hired') ? 'is-invalid' : '' }}" type="text" name="hired" id="hired" value="{{ old('hired') }}">
                @if($errors->has('hired'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hired') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.hired_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="years_in_profession">{{ trans('cruds.publicOfficial.fields.years_in_profession') }}</label>
                <input class="form-control {{ $errors->has('years_in_profession') ? 'is-invalid' : '' }}" type="text" name="years_in_profession" id="years_in_profession" value="{{ old('years_in_profession', '') }}">
                @if($errors->has('years_in_profession'))
                    <div class="invalid-feedback">
                        {{ $errors->first('years_in_profession') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.years_in_profession_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.publicOfficial.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone_number">{{ trans('cruds.publicOfficial.fields.phone_number') }}</label>
                <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', '') }}">
                @if($errors->has('phone_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.phone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="previous_agency">{{ trans('cruds.publicOfficial.fields.previous_agency') }}</label>
                <textarea class="form-control {{ $errors->has('previous_agency') ? 'is-invalid' : '' }}" name="previous_agency" id="previous_agency">{{ old('previous_agency') }}</textarea>
                @if($errors->has('previous_agency'))
                    <div class="invalid-feedback">
                        {{ $errors->first('previous_agency') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.previous_agency_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.publicOfficial.fields.notes') }}</label>
                <textarea class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes">{{ old('notes') }}</textarea>
                @if($errors->has('notes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('notes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="accuracy">{{ trans('cruds.publicOfficial.fields.accuracy') }}</label>
                <input class="form-control {{ $errors->has('accuracy') ? 'is-invalid' : '' }}" type="text" name="accuracy" id="accuracy" value="{{ old('accuracy', '') }}" required>
                @if($errors->has('accuracy'))
                    <div class="invalid-feedback">
                        {{ $errors->first('accuracy') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.accuracy_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="signature">{{ trans('cruds.publicOfficial.fields.signature') }}</label>
                <input class="form-control {{ $errors->has('signature') ? 'is-invalid' : '' }}" type="text" name="signature" id="signature" value="{{ old('signature', '') }}" required>
                @if($errors->has('signature'))
                    <div class="invalid-feedback">
                        {{ $errors->first('signature') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.signature_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="initials">{{ trans('cruds.publicOfficial.fields.initials') }}</label>
                <input class="form-control {{ $errors->has('initials') ? 'is-invalid' : '' }}" type="text" name="initials" id="initials" value="{{ old('initials', '') }}" required>
                @if($errors->has('initials'))
                    <div class="invalid-feedback">
                        {{ $errors->first('initials') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.initials_helper') }}</span>
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
    url: '{{ route('admin.public-officials.storeMedia') }}',
    maxFilesize: 50, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
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
@if(isset($publicOfficial) && $publicOfficial->image)
      var file = {!! json_encode($publicOfficial->image) !!}
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