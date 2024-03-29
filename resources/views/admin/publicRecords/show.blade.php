@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.publicRecord.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.public-records.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.publicRecord.fields.id') }}
                        </th>
                        <td>
                            {{ $publicRecord->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicRecord.fields.request_number') }}
                        </th>
                        <td>
                            {{ $publicRecord->request_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicRecord.fields.agency') }}
                        </th>
                        <td>
                            {{ $publicRecord->agency }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicRecord.fields.response_due') }}
                        </th>
                        <td>
                            {{ $publicRecord->response_due }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicRecord.fields.county') }}
                        </th>
                        <td>
                            {{ $publicRecord->county }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicRecord.fields.state') }}
                        </th>
                        <td>
                            {{ $publicRecord->state }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicRecord.fields.records_requested') }}
                        </th>
                        <td>
                            {{ $publicRecord->records_requested }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicRecord.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\PublicRecord::STATUS_SELECT[$publicRecord->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicRecord.fields.estimated_amount') }}
                        </th>
                        <td>
                            {{ $publicRecord->estimated_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicRecord.fields.amount_paid') }}
                        </th>
                        <td>
                            {{ $publicRecord->amount_paid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicRecord.fields.file') }}
                        </th>
                        <td>
                            @foreach($publicRecord->file as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.public-records.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection