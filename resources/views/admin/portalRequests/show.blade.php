@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.portalRequest.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.portal-requests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.portalRequest.fields.id') }}
                        </th>
                        <td>
                            {{ $portalRequest->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.portalRequest.fields.name') }}
                        </th>
                        <td>
                            {{ $portalRequest->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.portalRequest.fields.email') }}
                        </th>
                        <td>
                            {{ $portalRequest->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.portalRequest.fields.request') }}
                        </th>
                        <td>
                            {{ $portalRequest->request }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.portal-requests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection