@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.record.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.records.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.record.fields.id') }}
                        </th>
                        <td>
                            {{ $record->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.record.fields.date_added') }}
                        </th>
                        <td>
                            {{ $record->date_added }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.record.fields.full_name') }}
                        </th>
                        <td>
                            {{ $record->full_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.record.fields.record_type') }}
                        </th>
                        <td>
                            {{ $record->record_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.record.fields.record') }}
                        </th>
                        <td>
                            @foreach($record->record as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.record.fields.entered_by') }}
                        </th>
                        <td>
                            {{ $record->entered_by }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.record.fields.gtnn_number') }}
                        </th>
                        <td>
                            {{ $record->gtnn_number->gtnn_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.record.fields.agency') }}
                        </th>
                        <td>
                            {{ $record->agency->agency_name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.records.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection