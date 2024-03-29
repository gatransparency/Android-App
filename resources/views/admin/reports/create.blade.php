@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.report.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.reports.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="gtnn_number_id">{{ trans('cruds.report.fields.gtnn_number') }}</label>
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
                <span class="help-block">{{ trans('cruds.report.fields.gtnn_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="agency_id">{{ trans('cruds.report.fields.agency') }}</label>
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
                <span class="help-block">{{ trans('cruds.report.fields.agency_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="report_date">{{ trans('cruds.report.fields.report_date') }}</label>
                <input class="form-control date {{ $errors->has('report_date') ? 'is-invalid' : '' }}" type="text" name="report_date" id="report_date" value="{{ old('report_date') }}" required>
                @if($errors->has('report_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('report_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.report_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="report_number">{{ trans('cruds.report.fields.report_number') }}</label>
                <input class="form-control {{ $errors->has('report_number') ? 'is-invalid' : '' }}" type="text" name="report_number" id="report_number" value="{{ old('report_number', '') }}" required>
                @if($errors->has('report_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('report_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.report_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_of_occurance">{{ trans('cruds.report.fields.date_of_occurance') }}</label>
                <input class="form-control date {{ $errors->has('date_of_occurance') ? 'is-invalid' : '' }}" type="text" name="date_of_occurance" id="date_of_occurance" value="{{ old('date_of_occurance') }}" required>
                @if($errors->has('date_of_occurance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_of_occurance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.date_of_occurance_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="full_name">{{ trans('cruds.report.fields.full_name') }}</label>
                <input class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" type="text" name="full_name" id="full_name" value="{{ old('full_name', '') }}" required>
                @if($errors->has('full_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('full_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.full_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="time">{{ trans('cruds.report.fields.time') }}</label>
                <input class="form-control timepicker {{ $errors->has('time') ? 'is-invalid' : '' }}" type="text" name="time" id="time" value="{{ old('time') }}">
                @if($errors->has('time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="location">{{ trans('cruds.report.fields.location') }}</label>
                <input class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" type="text" name="location" id="location" value="{{ old('location', '') }}" required>
                @if($errors->has('location'))
                    <div class="invalid-feedback">
                        {{ $errors->first('location') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.location_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="narrative">{{ trans('cruds.report.fields.narrative') }}</label>
                <textarea class="form-control {{ $errors->has('narrative') ? 'is-invalid' : '' }}" name="narrative" id="narrative" required>{{ old('narrative') }}</textarea>
                @if($errors->has('narrative'))
                    <div class="invalid-feedback">
                        {{ $errors->first('narrative') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.narrative_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.report.fields.report_status') }}</label>
                <select class="form-control {{ $errors->has('report_status') ? 'is-invalid' : '' }}" name="report_status" id="report_status" required>
                    <option value disabled {{ old('report_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Report::REPORT_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('report_status', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('report_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('report_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.report_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.report.fields.release') }}</label>
                <select class="form-control {{ $errors->has('release') ? 'is-invalid' : '' }}" name="release" id="release" required>
                    <option value disabled {{ old('release', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Report::RELEASE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('release', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('release'))
                    <div class="invalid-feedback">
                        {{ $errors->first('release') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.release_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="admin_signature">{{ trans('cruds.report.fields.admin_signature') }}</label>
                <input class="form-control {{ $errors->has('admin_signature') ? 'is-invalid' : '' }}" type="text" name="admin_signature" id="admin_signature" value="{{ old('admin_signature', '') }}" required>
                @if($errors->has('admin_signature'))
                    <div class="invalid-feedback">
                        {{ $errors->first('admin_signature') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.admin_signature_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_approved">{{ trans('cruds.report.fields.date_approved') }}</label>
                <input class="form-control date {{ $errors->has('date_approved') ? 'is-invalid' : '' }}" type="text" name="date_approved" id="date_approved" value="{{ old('date_approved') }}">
                @if($errors->has('date_approved'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_approved') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.date_approved_helper') }}</span>
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