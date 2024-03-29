@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.agenciesOffice.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.agencies-offices.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.agenciesOffice.fields.id') }}
                        </th>
                        <td>
                            {{ $agenciesOffice->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agenciesOffice.fields.image') }}
                        </th>
                        <td>
                            @if($agenciesOffice->image)
                                <a href="{{ $agenciesOffice->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $agenciesOffice->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agenciesOffice.fields.agency_name') }}
                        </th>
                        <td>
                            {{ $agenciesOffice->agency_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agenciesOffice.fields.street_address') }}
                        </th>
                        <td>
                            {{ $agenciesOffice->street_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agenciesOffice.fields.street_address_additional') }}
                        </th>
                        <td>
                            {{ $agenciesOffice->street_address_additional }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agenciesOffice.fields.city') }}
                        </th>
                        <td>
                            {{ $agenciesOffice->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agenciesOffice.fields.state') }}
                        </th>
                        <td>
                            {{ $agenciesOffice->state }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agenciesOffice.fields.zip') }}
                        </th>
                        <td>
                            {{ $agenciesOffice->zip }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agenciesOffice.fields.website_url') }}
                        </th>
                        <td>
                            {{ $agenciesOffice->website_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agenciesOffice.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $agenciesOffice->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agenciesOffice.fields.agency_email') }}
                        </th>
                        <td>
                            {{ $agenciesOffice->agency_email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agenciesOffice.fields.fax') }}
                        </th>
                        <td>
                            {{ $agenciesOffice->fax }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agenciesOffice.fields.agency_rating') }}
                        </th>
                        <td>
                            {{ $agenciesOffice->agency_rating }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agenciesOffice.fields.notes') }}
                        </th>
                        <td>
                            {{ $agenciesOffice->notes }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.agencies-offices.index') }}">
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
            <a class="nav-link" href="#current_agency_public_officials" role="tab" data-toggle="tab">
                {{ trans('cruds.publicOfficial.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#agency_office_internal_investigations" role="tab" data-toggle="tab">
                {{ trans('cruds.internalInvestigation.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#agency_vehicle_vehicles" role="tab" data-toggle="tab">
                {{ trans('cruds.vehicle.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#agency_records" role="tab" data-toggle="tab">
                {{ trans('cruds.record.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#agency_reports" role="tab" data-toggle="tab">
                {{ trans('cruds.report.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#current_agency_public_official_datas" role="tab" data-toggle="tab">
                {{ trans('cruds.publicOfficialData.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="current_agency_public_officials">
            @includeIf('admin.agenciesOffices.relationships.currentAgencyPublicOfficials', ['publicOfficials' => $agenciesOffice->currentAgencyPublicOfficials])
        </div>
        <div class="tab-pane" role="tabpanel" id="agency_office_internal_investigations">
            @includeIf('admin.agenciesOffices.relationships.agencyOfficeInternalInvestigations', ['internalInvestigations' => $agenciesOffice->agencyOfficeInternalInvestigations])
        </div>
        <div class="tab-pane" role="tabpanel" id="agency_vehicle_vehicles">
            @includeIf('admin.agenciesOffices.relationships.agencyVehicleVehicles', ['vehicles' => $agenciesOffice->agencyVehicleVehicles])
        </div>
        <div class="tab-pane" role="tabpanel" id="agency_records">
            @includeIf('admin.agenciesOffices.relationships.agencyRecords', ['records' => $agenciesOffice->agencyRecords])
        </div>
        <div class="tab-pane" role="tabpanel" id="agency_reports">
            @includeIf('admin.agenciesOffices.relationships.agencyReports', ['reports' => $agenciesOffice->agencyReports])
        </div>
        <div class="tab-pane" role="tabpanel" id="current_agency_public_official_datas">
            @includeIf('admin.agenciesOffices.relationships.currentAgencyPublicOfficialDatas', ['publicOfficialDatas' => $agenciesOffice->currentAgencyPublicOfficialDatas])
        </div>
    </div>
</div>

@endsection