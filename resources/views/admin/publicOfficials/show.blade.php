@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.publicOfficial.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.public-officials.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.id') }}
                        </th>
                        <td>
                            {{ $publicOfficial->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.image') }}
                        </th>
                        <td>
                            @if($publicOfficial->image)
                                <a href="{{ $publicOfficial->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $publicOfficial->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.agency') }}
                        </th>
                        <td>
                            {{ $publicOfficial->agency->agency_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.public_official_number') }}
                        </th>
                        <td>
                            {{ $publicOfficial->public_official_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.first_name') }}
                        </th>
                        <td>
                            {{ $publicOfficial->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.middle_name') }}
                        </th>
                        <td>
                            {{ $publicOfficial->middle_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.last_name') }}
                        </th>
                        <td>
                            {{ $publicOfficial->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.badge_employee_number') }}
                        </th>
                        <td>
                            {{ $publicOfficial->badge_employee_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.sex') }}
                        </th>
                        <td>
                            {{ $publicOfficial->sex }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.rank') }}
                        </th>
                        <td>
                            {{ $publicOfficial->rank }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\PublicOfficial::STATUS_SELECT[$publicOfficial->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.officer_key_number') }}
                        </th>
                        <td>
                            {{ $publicOfficial->officer_key_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.hired') }}
                        </th>
                        <td>
                            {{ $publicOfficial->hired }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.years_in_profession') }}
                        </th>
                        <td>
                            {{ $publicOfficial->years_in_profession }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.email') }}
                        </th>
                        <td>
                            {{ $publicOfficial->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $publicOfficial->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.previous_agency') }}
                        </th>
                        <td>
                            {{ $publicOfficial->previous_agency }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.notes') }}
                        </th>
                        <td>
                            {{ $publicOfficial->notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.accuracy') }}
                        </th>
                        <td>
                            {{ $publicOfficial->accuracy }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.signature') }}
                        </th>
                        <td>
                            {{ $publicOfficial->signature }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.initials') }}
                        </th>
                        <td>
                            {{ $publicOfficial->initials }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.public-officials.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#official_number_reports" role="tab" data-toggle="tab">
                {{ trans('cruds.report.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#public_official_records" role="tab" data-toggle="tab">
                {{ trans('cruds.record.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#public_official_vehicles" role="tab" data-toggle="tab">
                {{ trans('cruds.vehicle.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#public_official_internal_investigations" role="tab" data-toggle="tab">
                {{ trans('cruds.internalInvestigation.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="official_number_reports">
            @includeIf('admin.publicOfficials.relationships.officialNumberReports', ['reports' => $publicOfficial->officialNumberReports])
        </div>
        <div class="tab-pane" role="tabpanel" id="public_official_records">
            @includeIf('admin.publicOfficials.relationships.publicOfficialRecords', ['records' => $publicOfficial->publicOfficialRecords])
        </div>
        <div class="tab-pane" role="tabpanel" id="public_official_vehicles">
            @includeIf('admin.publicOfficials.relationships.publicOfficialVehicles', ['vehicles' => $publicOfficial->publicOfficialVehicles])
        </div>
        <div class="tab-pane" role="tabpanel" id="public_official_internal_investigations">
            @includeIf('admin.publicOfficials.relationships.publicOfficialInternalInvestigations', ['internalInvestigations' => $publicOfficial->publicOfficialInternalInvestigations])
        </div>
    </div>
</div>

@endsection