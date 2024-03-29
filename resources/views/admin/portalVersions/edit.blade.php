@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.portalVersion.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.portal-versions.update", [$portalVersion->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="portal_version">{{ trans('cruds.portalVersion.fields.portal_version') }}</label>
                <input class="form-control {{ $errors->has('portal_version') ? 'is-invalid' : '' }}" type="text" name="portal_version" id="portal_version" value="{{ old('portal_version', $portalVersion->portal_version) }}">
                @if($errors->has('portal_version'))
                    <div class="invalid-feedback">
                        {{ $errors->first('portal_version') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.portalVersion.fields.portal_version_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection