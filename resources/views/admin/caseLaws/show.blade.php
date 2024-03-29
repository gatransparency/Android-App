@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.caseLaw.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.case-laws.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.caseLaw.fields.id') }}
                        </th>
                        <td>
                            {{ $caseLaw->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.caseLaw.fields.docket_number') }}
                        </th>
                        <td>
                            {{ $caseLaw->docket_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.caseLaw.fields.court') }}
                        </th>
                        <td>
                            {{ $caseLaw->court }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.caseLaw.fields.case') }}
                        </th>
                        <td>
                            {{ $caseLaw->case }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.caseLaw.fields.decided') }}
                        </th>
                        <td>
                            {{ $caseLaw->decided }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.caseLaw.fields.case_narrative') }}
                        </th>
                        <td>
                            {{ $caseLaw->case_narrative }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.caseLaw.fields.judge') }}
                        </th>
                        <td>
                            {{ $caseLaw->judge }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.caseLaw.fields.case_file') }}
                        </th>
                        <td>
                            @foreach($caseLaw->case_file as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.caseLaw.fields.added_by') }}
                        </th>
                        <td>
                            {{ $caseLaw->added_by }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.case-laws.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection