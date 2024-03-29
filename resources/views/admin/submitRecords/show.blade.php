@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.submitRecord.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.submit-records.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.submitRecord.fields.id') }}
                        </th>
                        <td>
                            {{ $submitRecord->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.submitRecord.fields.role') }}
                        </th>
                        <td>
                            {{ $submitRecord->role }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.submitRecord.fields.name') }}
                        </th>
                        <td>
                            {{ $submitRecord->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.submitRecord.fields.agency_affiliation') }}
                        </th>
                        <td>
                            {{ $submitRecord->agency_affiliation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.submitRecord.fields.address') }}
                        </th>
                        <td>
                            {{ $submitRecord->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.submitRecord.fields.image') }}
                        </th>
                        <td>
                            @foreach($submitRecord->image as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.submitRecord.fields.files') }}
                        </th>
                        <td>
                            @foreach($submitRecord->files as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.submitRecord.fields.narrative') }}
                        </th>
                        <td>
                            {{ $submitRecord->narrative }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.submit-records.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection