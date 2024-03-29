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
                            {{ trans('cruds.publicOfficial.fields.gtnn_number') }}
                        </th>
                        <td>
                            {{ $publicOfficial->gtnn_number }}
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
                            {{ trans('cruds.publicOfficial.fields.name') }}
                        </th>
                        <td>
                            {{ $publicOfficial->name }}
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
                            {{ trans('cruds.publicOfficial.fields.current_agency') }}
                        </th>
                        <td>
                            {{ $publicOfficial->current_agency->agency_name ?? '' }}
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
                            {{ trans('cruds.publicOfficial.fields.badge_number') }}
                        </th>
                        <td>
                            {{ $publicOfficial->badge_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.rank_position') }}
                        </th>
                        <td>
                            {{ $publicOfficial->rank_position }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.hourly_rate') }}
                        </th>
                        <td>
                            {{ $publicOfficial->hourly_rate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.annual_salary') }}
                        </th>
                        <td>
                            {{ $publicOfficial->annual_salary }}
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
                            {{ trans('cruds.publicOfficial.fields.okey_number') }}
                        </th>
                        <td>
                            {{ $publicOfficial->okey_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.years') }}
                        </th>
                        <td>
                            {{ $publicOfficial->years }}
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
                            {{ trans('cruds.publicOfficial.fields.previous_employment') }}
                        </th>
                        <td>
                            {{ $publicOfficial->previous_employment }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.professionalism') }}
                        </th>
                        <td>
                            {{ $publicOfficial->professionalism }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.appearance') }}
                        </th>
                        <td>
                            {{ $publicOfficial->appearance }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.uniform') }}
                        </th>
                        <td>
                            {{ $publicOfficial->uniform }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.attitude') }}
                        </th>
                        <td>
                            {{ $publicOfficial->attitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.law_knowledge') }}
                        </th>
                        <td>
                            {{ $publicOfficial->law_knowledge }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.rights_violations') }}
                        </th>
                        <td>
                            {{ $publicOfficial->rights_violations }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficial.fields.if_yes') }}
                        </th>
                        <td>
                            {{ $publicOfficial->if_yes }}
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
            <a class="nav-link" href="#gtnn_number_reports" role="tab" data-toggle="tab">
                {{ trans('cruds.report.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#gtnn_number_vehicles" role="tab" data-toggle="tab">
                {{ trans('cruds.vehicle.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#gtnn_number_internal_investigations" role="tab" data-toggle="tab">
                {{ trans('cruds.internalInvestigation.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#gtnn_number_records" role="tab" data-toggle="tab">
                {{ trans('cruds.record.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="gtnn_number_reports">
            @includeIf('admin.publicOfficials.relationships.gtnnNumberReports', ['reports' => $publicOfficial->gtnnNumberReports])
        </div>
        <div class="tab-pane" role="tabpanel" id="gtnn_number_vehicles">
            @includeIf('admin.publicOfficials.relationships.gtnnNumberVehicles', ['vehicles' => $publicOfficial->gtnnNumberVehicles])
        </div>
        <div class="tab-pane" role="tabpanel" id="gtnn_number_internal_investigations">
            @includeIf('admin.publicOfficials.relationships.gtnnNumberInternalInvestigations', ['internalInvestigations' => $publicOfficial->gtnnNumberInternalInvestigations])
        </div>
        <div class="tab-pane" role="tabpanel" id="gtnn_number_records">
            @includeIf('admin.publicOfficials.relationships.gtnnNumberRecords', ['records' => $publicOfficial->gtnnNumberRecords])
        </div>
    </div>
</div>

@endsection