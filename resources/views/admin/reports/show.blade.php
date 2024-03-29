@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.report.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reports.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.id') }}
                        </th>
                        <td>
                            {{ $report->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.gtnn_number') }}
                        </th>
                        <td>
                            {{ $report->gtnn_number->gtnn_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.agency') }}
                        </th>
                        <td>
                            {{ $report->agency->agency_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.report_date') }}
                        </th>
                        <td>
                            {{ $report->report_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.report_number') }}
                        </th>
                        <td>
                            {{ $report->report_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.date_of_occurance') }}
                        </th>
                        <td>
                            {{ $report->date_of_occurance }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.full_name') }}
                        </th>
                        <td>
                            {{ $report->full_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.time') }}
                        </th>
                        <td>
                            {{ $report->time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.location') }}
                        </th>
                        <td>
                            {{ $report->location }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.narrative') }}
                        </th>
                        <td>
                            {{ $report->narrative }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.report_status') }}
                        </th>
                        <td>
                            {{ App\Models\Report::REPORT_STATUS_SELECT[$report->report_status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.release') }}
                        </th>
                        <td>
                            {{ App\Models\Report::RELEASE_SELECT[$report->release] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.admin_signature') }}
                        </th>
                        <td>
                            {{ $report->admin_signature }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.date_approved') }}
                        </th>
                        <td>
                            {{ $report->date_approved }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reports.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection