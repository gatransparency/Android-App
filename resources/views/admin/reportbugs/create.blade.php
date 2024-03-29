@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.reportbug.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.reportbugs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.reportbug.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.reportbug.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.reportbug.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.reportbug.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="synopsis">{{ trans('cruds.reportbug.fields.synopsis') }}</label>
                <textarea class="form-control {{ $errors->has('synopsis') ? 'is-invalid' : '' }}" name="synopsis" id="synopsis" required>{{ old('synopsis') }}</textarea>
                @if($errors->has('synopsis'))
                    <div class="invalid-feedback">
                        {{ $errors->first('synopsis') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.reportbug.fields.synopsis_helper') }}</span>
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