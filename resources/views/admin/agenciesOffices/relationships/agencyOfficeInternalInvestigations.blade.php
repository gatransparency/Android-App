@can('internal_investigation_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.internal-investigations.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.internalInvestigation.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.internalInvestigation.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-agencyOfficeInternalInvestigations">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.internalInvestigation.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.internalInvestigation.fields.ia_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.internalInvestigation.fields.gtnn_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.internalInvestigation.fields.agency_office') }}
                        </th>
                        <th>
                            {{ trans('cruds.internalInvestigation.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.internalInvestigation.fields.investigator') }}
                        </th>
                        <th>
                            {{ trans('cruds.internalInvestigation.fields.narrative') }}
                        </th>
                        <th>
                            {{ trans('cruds.internalInvestigation.fields.files') }}
                        </th>
                        <th>
                            {{ trans('cruds.internalInvestigation.fields.entered_by') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($internalInvestigations as $key => $internalInvestigation)
                        <tr data-entry-id="{{ $internalInvestigation->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $internalInvestigation->id ?? '' }}
                            </td>
                            <td>
                                {{ $internalInvestigation->ia_date ?? '' }}
                            </td>
                            <td>
                                {{ $internalInvestigation->gtnn_number->gtnn_number ?? '' }}
                            </td>
                            <td>
                                {{ $internalInvestigation->agency_office->agency_name ?? '' }}
                            </td>
                            <td>
                                {{ $internalInvestigation->name ?? '' }}
                            </td>
                            <td>
                                {{ $internalInvestigation->investigator ?? '' }}
                            </td>
                            <td>
                                {{ $internalInvestigation->narrative ?? '' }}
                            </td>
                            <td>
                                @foreach($internalInvestigation->files as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $internalInvestigation->entered_by ?? '' }}
                            </td>
                            <td>
                                @can('internal_investigation_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.internal-investigations.show', $internalInvestigation->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('internal_investigation_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.internal-investigations.edit', $internalInvestigation->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('internal_investigation_delete')
                                    <form action="{{ route('admin.internal-investigations.destroy', $internalInvestigation->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('internal_investigation_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.internal-investigations.massDestroy') }}",
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
  let table = $('.datatable-agencyOfficeInternalInvestigations:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection