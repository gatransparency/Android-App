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
                            {{ trans('cruds.internalInvestigation.fields.ia_date') }}
                        </th>
                        <td>
                            {{ $internalInvestigation->ia_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.internalInvestigation.fields.gtnn_number') }}
                        </th>
                        <td>
                            {{ $internalInvestigation->gtnn_number->gtnn_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.internalInvestigation.fields.agency_office') }}
                        </th>
                        <td>
                            {{ $internalInvestigation->agency_office->agency_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.internalInvestigation.fields.name') }}
                        </th>
                        <td>
                            {{ $internalInvestigation->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.internalInvestigation.fields.investigator') }}
                        </th>
                        <td>
                            {{ $internalInvestigation->investigator }}
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
                            {{ trans('cruds.internalInvestigation.fields.files') }}
                        </th>
                        <td>
                            @foreach($internalInvestigation->files as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.internalInvestigation.fields.entered_by') }}
                        </th>
                        <td>
                            {{ $internalInvestigation->entered_by }}
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