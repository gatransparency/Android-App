@extends('layouts.admin')
@section('content')
@can('report_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.reports.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.report.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Report', 'route' => 'admin.reports.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.report.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Report">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.report.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.report.fields.agency') }}
                    </th>
                    <th>
                        {{ trans('cruds.report.fields.official_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.report.fields.report_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.report.fields.report_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.report.fields.full_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.report.fields.date_of_occurance') }}
                    </th>
                    <th>
                        {{ trans('cruds.report.fields.time') }}
                    </th>
                    <th>
                        {{ trans('cruds.report.fields.location') }}
                    </th>
                    <th>
                        {{ trans('cruds.report.fields.narrative') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('report_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.reports.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.reports.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'agency_agency_name', name: 'agency.agency_name' },
{ data: 'official_number_public_official_number', name: 'official_number.public_official_number' },
{ data: 'report_date', name: 'report_date' },
{ data: 'report_number', name: 'report_number' },
{ data: 'full_name', name: 'full_name' },
{ data: 'date_of_occurance', name: 'date_of_occurance' },
{ data: 'time', name: 'time' },
{ data: 'location', name: 'location' },
{ data: 'narrative', name: 'narrative' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Report').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection