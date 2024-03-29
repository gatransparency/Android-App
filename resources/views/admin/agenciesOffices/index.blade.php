@extends('layouts.admin')
@section('content')
@can('agencies_office_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.agencies-offices.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.agenciesOffice.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'AgenciesOffice', 'route' => 'admin.agencies-offices.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.agenciesOffice.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-AgenciesOffice">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.agenciesOffice.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.agenciesOffice.fields.image') }}
                    </th>
                    <th>
                        {{ trans('cruds.agenciesOffice.fields.agency_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.agenciesOffice.fields.street_address') }}
                    </th>
                    <th>
                        {{ trans('cruds.agenciesOffice.fields.street_address_additional') }}
                    </th>
                    <th>
                        {{ trans('cruds.agenciesOffice.fields.city') }}
                    </th>
                    <th>
                        {{ trans('cruds.agenciesOffice.fields.state') }}
                    </th>
                    <th>
                        {{ trans('cruds.agenciesOffice.fields.zip') }}
                    </th>
                    <th>
                        {{ trans('cruds.agenciesOffice.fields.website_url') }}
                    </th>
                    <th>
                        {{ trans('cruds.agenciesOffice.fields.phone_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.agenciesOffice.fields.agency_email') }}
                    </th>
                    <th>
                        {{ trans('cruds.agenciesOffice.fields.fax') }}
                    </th>
                    <th>
                        {{ trans('cruds.agenciesOffice.fields.agency_rating') }}
                    </th>
                    <th>
                        {{ trans('cruds.agenciesOffice.fields.notes') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
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
@can('agencies_office_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.agencies-offices.massDestroy') }}",
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
    ajax: "{{ route('admin.agencies-offices.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'image', name: 'image', sortable: false, searchable: false },
{ data: 'agency_name', name: 'agency_name' },
{ data: 'street_address', name: 'street_address' },
{ data: 'street_address_additional', name: 'street_address_additional' },
{ data: 'city', name: 'city' },
{ data: 'state', name: 'state' },
{ data: 'zip', name: 'zip' },
{ data: 'website_url', name: 'website_url' },
{ data: 'phone_number', name: 'phone_number' },
{ data: 'agency_email', name: 'agency_email' },
{ data: 'fax', name: 'fax' },
{ data: 'agency_rating', name: 'agency_rating' },
{ data: 'notes', name: 'notes' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-AgenciesOffice').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
});

</script>
@endsection