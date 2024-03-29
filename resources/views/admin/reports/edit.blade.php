@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.report.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.reports.update", [$report->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="agency_id">{{ trans('cruds.report.fields.agency') }}</label>
                <select class="form-control select2 {{ $errors->has('agency') ? 'is-invalid' : '' }}" name="agency_id" id="agency_id">
                    @foreach($agencies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('agency_id') ? old('agency_id') : $report->agency->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <label class="required" for="official_number_id">{{ trans('cruds.report.fields.official_number') }}</label>
                <select class="form-control select2 {{ $errors->has('official_number') ? 'is-invalid' : '' }}" name="official_number_id" id="official_number_id" required>
                    @foreach($official_numbers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('official_number_id') ? old('official_number_id') : $report->official_number->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('official_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('official_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.official_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="report_number">{{ trans('cruds.report.fields.report_number') }}</label>
                <input class="form-control {{ $errors->has('report_number') ? 'is-invalid' : '' }}" type="text" name="report_number" id="report_number" value="{{ old('report_number', $report->report_number) }}" required>
                @if($errors->has('report_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('report_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.report_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="full_name">{{ trans('cruds.report.fields.full_name') }}</label>
                <input class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" type="text" name="full_name" id="full_name" value="{{ old('full_name', $report->full_name) }}" required>
                @if($errors->has('full_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('full_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.full_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_of_occurance">{{ trans('cruds.report.fields.date_of_occurance') }}</label>
                <input class="form-control date {{ $errors->has('date_of_occurance') ? 'is-invalid' : '' }}" type="text" name="date_of_occurance" id="date_of_occurance" value="{{ old('date_of_occurance', $report->date_of_occurance) }}" required>
                @if($errors->has('date_of_occurance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_of_occurance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.date_of_occurance_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="time">{{ trans('cruds.report.fields.time') }}</label>
                <input class="form-control timepicker {{ $errors->has('time') ? 'is-invalid' : '' }}" type="text" name="time" id="time" value="{{ old('time', $report->time) }}" required>
                @if($errors->has('time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="location">{{ trans('cruds.report.fields.location') }}</label>
                <input class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" type="text" name="location" id="location" value="{{ old('location', $report->location) }}" required>
                @if($errors->has('location'))
                    <div class="invalid-feedback">
                        {{ $errors->first('location') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.location_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="narrative">{{ trans('cruds.report.fields.narrative') }}</label>
                <textarea class="form-control {{ $errors->has('narrative') ? 'is-invalid' : '' }}" name="narrative" id="narrative" required>{{ old('narrative', $report->narrative) }}</textarea>
                @if($errors->has('narrative'))
                    <div class="invalid-feedback">
                        {{ $errors->first('narrative') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.narrative_helper') }}</span>
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