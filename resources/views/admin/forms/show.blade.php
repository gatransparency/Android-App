@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.form.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.forms.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.form.fields.id') }}
                        </th>
                        <td>
                            {{ $form->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.form.fields.form_number') }}
                        </th>
                        <td>
                            {{ $form->form_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.form.fields.form_name') }}
                        </th>
                        <td>
                            {{ $form->form_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.form.fields.form_format') }}
                        </th>
                        <td>
                            {{ App\Models\Form::FORM_FORMAT_SELECT[$form->form_format] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.form.fields.form') }}
                        </th>
                        <td>
                            @foreach($form->form as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.forms.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection