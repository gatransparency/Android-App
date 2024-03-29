@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.internalInvestigation.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.internal-investigations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.internalInvestigation.fields.id') }}
                        </th>
                        <td>
                            {{ $internalInvestigation->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.internalInvestigation.fields.agency') }}
                        </th>
                        <td>
                            {{ $internalInvestigation->agency->agency_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.internalInvestigation.fields.public_official') }}
                        </th>
                        <td>
                            {{ $internalInvestigation->public_official->public_official_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.internalInvestigation.fields.narrative') }}
                        </th>
                        <td>
                            {{ $internalInvestigation->narrative }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.internalInvestigation.fields.file') }}
                        </th>
                        <td>
                            @foreach($internalInvestigation->file as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.internalInvestigation.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\InternalInvestigation::STATUS_SELECT[$internalInvestigation->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.internalInvestigation.fields.entered_by') }}
                        </th>
                        <td>
                            {{ $internalInvestigation->entered_by->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.internal-investigations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection