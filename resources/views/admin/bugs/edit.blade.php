@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.bug.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bugs.update", [$bug->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="version_id">{{ trans('cruds.bug.fields.version') }}</label>
                <select class="form-control select2 {{ $errors->has('version') ? 'is-invalid' : '' }}" name="version_id" id="version_id" required>
                    @foreach($versions as $id => $entry)
                        <option value="{{ $id }}" {{ (old('version_id') ? old('version_id') : $bug->version->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('version'))
                    <div class="invalid-feedback">
                        {{ $errors->first('version') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bug.fields.version_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.bug.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $bug->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bug.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status">{{ trans('cruds.bug.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ old('status', $bug->status) }}" required>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bug.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="synopsis">{{ trans('cruds.bug.fields.synopsis') }}</label>
                <textarea class="form-control {{ $errors->has('synopsis') ? 'is-invalid' : '' }}" name="synopsis" id="synopsis" required>{{ old('synopsis', $bug->synopsis) }}</textarea>
                @if($errors->has('synopsis'))
                    <div class="invalid-feedback">
                        {{ $errors->first('synopsis') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bug.fields.synopsis_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fixed">{{ trans('cruds.bug.fields.fixed') }}</label>
                <input class="form-control date {{ $errors->has('fixed') ? 'is-invalid' : '' }}" type="text" name="fixed" id="fixed" value="{{ old('fixed', $bug->fixed) }}">
                @if($errors->has('fixed'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fixed') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bug.fields.fixed_helper') }}</span>
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