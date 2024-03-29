@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.publicOfficialData.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.public-official-datas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.id') }}
                        </th>
                        <td>
                            {{ $publicOfficialData->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.gtnn_number') }}
                        </th>
                        <td>
                            {{ $publicOfficialData->gtnn_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.image') }}
                        </th>
                        <td>
                            @if($publicOfficialData->image)
                                <a href="{{ $publicOfficialData->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $publicOfficialData->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.name') }}
                        </th>
                        <td>
                            {{ $publicOfficialData->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.email') }}
                        </th>
                        <td>
                            {{ $publicOfficialData->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.current_agency') }}
                        </th>
                        <td>
                            {{ $publicOfficialData->current_agency->agency_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.hired') }}
                        </th>
                        <td>
                            {{ $publicOfficialData->hired }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.badge_number') }}
                        </th>
                        <td>
                            {{ $publicOfficialData->badge_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.rank_position') }}
                        </th>
                        <td>
                            {{ $publicOfficialData->rank_position }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.hourly_rate') }}
                        </th>
                        <td>
                            {{ $publicOfficialData->hourly_rate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.annual_salary') }}
                        </th>
                        <td>
                            {{ $publicOfficialData->annual_salary }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\PublicOfficialData::STATUS_SELECT[$publicOfficialData->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.okey_number') }}
                        </th>
                        <td>
                            {{ $publicOfficialData->okey_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.years') }}
                        </th>
                        <td>
                            {{ $publicOfficialData->years }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $publicOfficialData->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.previous_employment') }}
                        </th>
                        <td>
                            {{ $publicOfficialData->previous_employment }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.professionalism') }}
                        </th>
                        <td>
                            {{ $publicOfficialData->professionalism }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.appearance') }}
                        </th>
                        <td>
                            {{ $publicOfficialData->appearance }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.uniform') }}
                        </th>
                        <td>
                            {{ $publicOfficialData->uniform }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.attitude') }}
                        </th>
                        <td>
                            {{ $publicOfficialData->attitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.law_knowledge') }}
                        </th>
                        <td>
                            {{ $publicOfficialData->law_knowledge }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.rights_violations') }}
                        </th>
                        <td>
                            {{ $publicOfficialData->rights_violations }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.if_yes') }}
                        </th>
                        <td>
                            {{ $publicOfficialData->if_yes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.notes') }}
                        </th>
                        <td>
                            {{ $publicOfficialData->notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.signature') }}
                        </th>
                        <td>
                            {{ $publicOfficialData->signature }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.initials') }}
                        </th>
                        <td>
                            {{ $publicOfficialData->initials }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.public-official-datas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection