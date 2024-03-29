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
                <label class="required" for="gtnn_number">{{ trans('cruds.publicOfficial.fields.gtnn_number') }}</label>
                <input class="form-control {{ $errors->has('gtnn_number') ? 'is-invalid' : '' }}" type="text" name="gtnn_number" id="gtnn_number" value="{{ old('gtnn_number', '') }}" required>
                @if($errors->has('gtnn_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gtnn_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.gtnn_number_helper') }}</span>
            </div>
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
                <label class="required" for="name">{{ trans('cruds.publicOfficial.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.name_helper') }}</span>
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
                <label for="current_agency_id">{{ trans('cruds.publicOfficial.fields.current_agency') }}</label>
                <select class="form-control select2 {{ $errors->has('current_agency') ? 'is-invalid' : '' }}" name="current_agency_id" id="current_agency_id">
                    @foreach($current_agencies as $id => $entry)
                        <option value="{{ $id }}" {{ old('current_agency_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('current_agency'))
                    <div class="invalid-feedback">
                        {{ $errors->first('current_agency') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.current_agency_helper') }}</span>
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
                <label for="badge_number">{{ trans('cruds.publicOfficial.fields.badge_number') }}</label>
                <input class="form-control {{ $errors->has('badge_number') ? 'is-invalid' : '' }}" type="text" name="badge_number" id="badge_number" value="{{ old('badge_number', '') }}">
                @if($errors->has('badge_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('badge_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.badge_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="rank_position">{{ trans('cruds.publicOfficial.fields.rank_position') }}</label>
                <input class="form-control {{ $errors->has('rank_position') ? 'is-invalid' : '' }}" type="text" name="rank_position" id="rank_position" value="{{ old('rank_position', '') }}" required>
                @if($errors->has('rank_position'))
                    <div class="invalid-feedback">
                        {{ $errors->first('rank_position') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.rank_position_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hourly_rate">{{ trans('cruds.publicOfficial.fields.hourly_rate') }}</label>
                <input class="form-control {{ $errors->has('hourly_rate') ? 'is-invalid' : '' }}" type="number" name="hourly_rate" id="hourly_rate" value="{{ old('hourly_rate', '') }}" step="0.01">
                @if($errors->has('hourly_rate'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hourly_rate') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.hourly_rate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="annual_salary">{{ trans('cruds.publicOfficial.fields.annual_salary') }}</label>
                <input class="form-control {{ $errors->has('annual_salary') ? 'is-invalid' : '' }}" type="number" name="annual_salary" id="annual_salary" value="{{ old('annual_salary', '') }}" step="0.01">
                @if($errors->has('annual_salary'))
                    <div class="invalid-feedback">
                        {{ $errors->first('annual_salary') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.annual_salary_helper') }}</span>
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
                <label for="okey_number">{{ trans('cruds.publicOfficial.fields.okey_number') }}</label>
                <input class="form-control {{ $errors->has('okey_number') ? 'is-invalid' : '' }}" type="text" name="okey_number" id="okey_number" value="{{ old('okey_number', '') }}">
                @if($errors->has('okey_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('okey_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.okey_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="years">{{ trans('cruds.publicOfficial.fields.years') }}</label>
                <input class="form-control {{ $errors->has('years') ? 'is-invalid' : '' }}" type="text" name="years" id="years" value="{{ old('years', '') }}">
                @if($errors->has('years'))
                    <div class="invalid-feedback">
                        {{ $errors->first('years') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.years_helper') }}</span>
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
                <label for="previous_employment">{{ trans('cruds.publicOfficial.fields.previous_employment') }}</label>
                <textarea class="form-control {{ $errors->has('previous_employment') ? 'is-invalid' : '' }}" name="previous_employment" id="previous_employment">{{ old('previous_employment') }}</textarea>
                @if($errors->has('previous_employment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('previous_employment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.previous_employment_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="professionalism">{{ trans('cruds.publicOfficial.fields.professionalism') }}</label>
                <input class="form-control {{ $errors->has('professionalism') ? 'is-invalid' : '' }}" type="text" name="professionalism" id="professionalism" value="{{ old('professionalism', '') }}">
                @if($errors->has('professionalism'))
                    <div class="invalid-feedback">
                        {{ $errors->first('professionalism') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.professionalism_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="appearance">{{ trans('cruds.publicOfficial.fields.appearance') }}</label>
                <input class="form-control {{ $errors->has('appearance') ? 'is-invalid' : '' }}" type="text" name="appearance" id="appearance" value="{{ old('appearance', '') }}">
                @if($errors->has('appearance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('appearance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.appearance_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="uniform">{{ trans('cruds.publicOfficial.fields.uniform') }}</label>
                <input class="form-control {{ $errors->has('uniform') ? 'is-invalid' : '' }}" type="text" name="uniform" id="uniform" value="{{ old('uniform', '') }}">
                @if($errors->has('uniform'))
                    <div class="invalid-feedback">
                        {{ $errors->first('uniform') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.uniform_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attitude">{{ trans('cruds.publicOfficial.fields.attitude') }}</label>
                <input class="form-control {{ $errors->has('attitude') ? 'is-invalid' : '' }}" type="text" name="attitude" id="attitude" value="{{ old('attitude', '') }}">
                @if($errors->has('attitude'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attitude') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.attitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="law_knowledge">{{ trans('cruds.publicOfficial.fields.law_knowledge') }}</label>
                <input class="form-control {{ $errors->has('law_knowledge') ? 'is-invalid' : '' }}" type="text" name="law_knowledge" id="law_knowledge" value="{{ old('law_knowledge', '') }}">
                @if($errors->has('law_knowledge'))
                    <div class="invalid-feedback">
                        {{ $errors->first('law_knowledge') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.law_knowledge_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="rights_violations">{{ trans('cruds.publicOfficial.fields.rights_violations') }}</label>
                <input class="form-control {{ $errors->has('rights_violations') ? 'is-invalid' : '' }}" type="text" name="rights_violations" id="rights_violations" value="{{ old('rights_violations', '') }}">
                @if($errors->has('rights_violations'))
                    <div class="invalid-feedback">
                        {{ $errors->first('rights_violations') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.rights_violations_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="if_yes">{{ trans('cruds.publicOfficial.fields.if_yes') }}</label>
                <textarea class="form-control {{ $errors->has('if_yes') ? 'is-invalid' : '' }}" name="if_yes" id="if_yes">{{ old('if_yes') }}</textarea>
                @if($errors->has('if_yes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('if_yes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicOfficial.fields.if_yes_helper') }}</span>
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