@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.portalVersion.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.portal-versions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.portalVersion.fields.id') }}
                        </th>
                        <td>
                            {{ $portalVersion->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.portalVersion.fields.portal_version') }}
                        </th>
                        <td>
                            {{ $portalVersion->portal_version }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.portal-versions.index') }}">
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
            <a class="nav-link" href="#version_bugs" role="tab" data-toggle="tab">
                {{ trans('cruds.bug.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#portal_version_change_logs" role="tab" data-toggle="tab">
                {{ trans('cruds.changeLog.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="version_bugs">
            @includeIf('admin.portalVersions.relationships.versionBugs', ['bugs' => $portalVersion->versionBugs])
        </div>
        <div class="tab-pane" role="tabpanel" id="portal_version_change_logs">
            @includeIf('admin.portalVersions.relationships.portalVersionChangeLogs', ['changeLogs' => $portalVersion->portalVersionChangeLogs])
        </div>
    </div>
</div>

@endsection