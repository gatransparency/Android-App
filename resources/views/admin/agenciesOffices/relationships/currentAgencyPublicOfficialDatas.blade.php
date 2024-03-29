@can('public_official_data_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.public-official-datas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.publicOfficialData.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.publicOfficialData.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-currentAgencyPublicOfficialDatas">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.gtnn_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.current_agency') }}
                        </th>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.hired') }}
                        </th>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.badge_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.rank_position') }}
                        </th>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.hourly_rate') }}
                        </th>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.annual_salary') }}
                        </th>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.okey_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.years') }}
                        </th>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.phone_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.previous_employment') }}
                        </th>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.professionalism') }}
                        </th>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.appearance') }}
                        </th>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.uniform') }}
                        </th>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.attitude') }}
                        </th>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.law_knowledge') }}
                        </th>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.rights_violations') }}
                        </th>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.if_yes') }}
                        </th>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.notes') }}
                        </th>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.signature') }}
                        </th>
                        <th>
                            {{ trans('cruds.publicOfficialData.fields.initials') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($publicOfficialDatas as $key => $publicOfficialData)
                        <tr data-entry-id="{{ $publicOfficialData->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $publicOfficialData->id ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficialData->gtnn_number ?? '' }}
                            </td>
                            <td>
                                @if($publicOfficialData->image)
                                    <a href="{{ $publicOfficialData->image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $publicOfficialData->image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $publicOfficialData->name ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficialData->email ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficialData->current_agency->agency_name ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficialData->hired ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficialData->badge_number ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficialData->rank_position ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficialData->hourly_rate ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficialData->annual_salary ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\PublicOfficialData::STATUS_SELECT[$publicOfficialData->status] ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficialData->okey_number ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficialData->years ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficialData->phone_number ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficialData->previous_employment ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficialData->professionalism ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficialData->appearance ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficialData->uniform ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficialData->attitude ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficialData->law_knowledge ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficialData->rights_violations ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficialData->if_yes ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficialData->notes ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficialData->signature ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficialData->initials ?? '' }}
                            </td>
                            <td>
                                @can('public_official_data_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.public-official-datas.show', $publicOfficialData->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('public_official_data_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.public-official-datas.edit', $publicOfficialData->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('public_official_data_delete')
                                    <form action="{{ route('admin.public-official-datas.destroy', $publicOfficialData->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('public_official_data_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.public-official-datas.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-currentAgencyPublicOfficialDatas:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection