@extends('layouts.admin')
@section('content')
@can('vehicle_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.vehicles.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.vehicle.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Vehicle', 'route' => 'admin.vehicles.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.vehicle.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Vehicle">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.vehicle.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.vehicle.fields.agency') }}
                    </th>
                    <th>
                        {{ trans('cruds.vehicle.fields.public_official') }}
                    </th>
                    <th>
                        {{ trans('cruds.vehicle.fields.image') }}
                    </th>
                    <th>
                        {{ trans('cruds.vehicle.fields.make') }}
                    </th>
                    <th>
                        {{ trans('cruds.vehicle.fields.model') }}
                    </th>
                    <th>
                        {{ trans('cruds.vehicle.fields.year') }}
                    </th>
                    <th>
                        {{ trans('cruds.vehicle.fields.number') }}
                    </th>
                    <th>
                        {{ trans('cruds.vehicle.fields.marked') }}
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
@can('vehicle_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.vehicles.massDestroy') }}",
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
    ajax: "{{ route('admin.vehicles.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'agency_agency_name', name: 'agency.agency_name' },
{ data: 'public_official_public_official_number', name: 'public_official.public_official_number' },
{ data: 'image', name: 'image', sortable: false, searchable: false },
{ data: 'make', name: 'make' },
{ data: 'model', name: 'model' },
{ data: 'year', name: 'year' },
{ data: 'number', name: 'number' },
{ data: 'marked', name: 'marked' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Vehicle').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection