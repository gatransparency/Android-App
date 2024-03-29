@extends('layouts.admin')
@section('content')
@can('public_record_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.public-records.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.publicRecord.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'PublicRecord', 'route' => 'admin.public-records.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.publicRecord.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-PublicRecord">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.publicRecord.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicRecord.fields.request_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicRecord.fields.agency') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicRecord.fields.response_due') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicRecord.fields.county') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicRecord.fields.state') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicRecord.fields.records_requested') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicRecord.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicRecord.fields.estimated_amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicRecord.fields.amount_paid') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicRecord.fields.file') }}
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
@can('public_record_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.public-records.massDestroy') }}",
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
    ajax: "{{ route('admin.public-records.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'request_number', name: 'request_number' },
{ data: 'agency', name: 'agency' },
{ data: 'response_due', name: 'response_due' },
{ data: 'county', name: 'county' },
{ data: 'state', name: 'state' },
{ data: 'records_requested', name: 'records_requested' },
{ data: 'status', name: 'status' },
{ data: 'estimated_amount', name: 'estimated_amount' },
{ data: 'amount_paid', name: 'amount_paid' },
{ data: 'file', name: 'file', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-PublicRecord').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection