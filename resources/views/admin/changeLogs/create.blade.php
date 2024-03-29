@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.changeLog.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.change-logs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="portal_version_id">{{ trans('cruds.changeLog.fields.portal_version') }}</label>
                <select class="form-control select2 {{ $errors->has('portal_version') ? 'is-invalid' : '' }}" name="portal_version_id" id="portal_version_id" required>
                    @foreach($portal_versions as $id => $entry)
                        <option value="{{ $id }}" {{ old('portal_version_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('portal_version'))
                    <div class="invalid-feedback">
                        {{ $errors->first('portal_version') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.changeLog.fields.portal_version_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.changeLog.fields.change') }}</label>
                <select class="form-control {{ $errors->has('change') ? 'is-invalid' : '' }}" name="change" id="change" required>
                    <option value disabled {{ old('change', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ChangeLog::CHANGE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('change', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('change'))
                    <div class="invalid-feedback">
                        {{ $errors->first('change') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.changeLog.fields.change_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="log">{{ trans('cruds.changeLog.fields.log') }}</label>
                <textarea class="form-control {{ $errors->has('log') ? 'is-invalid' : '' }}" name="log" id="log" required>{{ old('log') }}</textarea>
                @if($errors->has('log'))
                    <div class="invalid-feedback">
                        {{ $errors->first('log') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.changeLog.fields.log_helper') }}</span>
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