@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.reportbug.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reportbugs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.reportbug.fields.id') }}
                        </th>
                        <td>
                            {{ $reportbug->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reportbug.fields.name') }}
                        </th>
                        <td>
                            {{ $reportbug->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reportbug.fields.email') }}
                        </th>
                        <td>
                            {{ $reportbug->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reportbug.fields.synopsis') }}
                        </th>
                        <td>
                            {{ $reportbug->synopsis }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reportbugs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection