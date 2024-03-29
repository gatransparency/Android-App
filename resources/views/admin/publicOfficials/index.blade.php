@extends('layouts.admin')
@section('content')
@can('public_official_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.public-officials.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.publicOfficial.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'PublicOfficial', 'route' => 'admin.public-officials.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.publicOfficial.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-PublicOfficial">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.publicOfficial.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicOfficial.fields.image') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicOfficial.fields.agency') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicOfficial.fields.public_official_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicOfficial.fields.first_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicOfficial.fields.middle_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicOfficial.fields.last_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicOfficial.fields.badge_employee_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicOfficial.fields.sex') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicOfficial.fields.rank') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicOfficial.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicOfficial.fields.officer_key_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicOfficial.fields.hired') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicOfficial.fields.years_in_profession') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicOfficial.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicOfficial.fields.phone_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicOfficial.fields.previous_agency') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicOfficial.fields.notes') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicOfficial.fields.accuracy') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicOfficial.fields.signature') }}
                    </th>
                    <th>
                        {{ trans('cruds.publicOfficial.fields.initials') }}
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
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($agencies_offices as $key => $item)
                                <option value="{{ $item->agency_name }}">{{ $item->agency_name }}</option>
                            @endforeach
                        </select>
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
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\PublicOfficial::STATUS_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
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
@can('public_official_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.public-officials.massDestroy') }}",
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
    ajax: "{{ route('admin.public-officials.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'image', name: 'image', sortable: false, searchable: false },
{ data: 'agency_agency_name', name: 'agency.agency_name' },
{ data: 'public_official_number', name: 'public_official_number' },
{ data: 'first_name', name: 'first_name' },
{ data: 'middle_name', name: 'middle_name' },
{ data: 'last_name', name: 'last_name' },
{ data: 'badge_employee_number', name: 'badge_employee_number' },
{ data: 'sex', name: 'sex' },
{ data: 'rank', name: 'rank' },
{ data: 'status', name: 'status' },
{ data: 'officer_key_number', name: 'officer_key_number' },
{ data: 'hired', name: 'hired' },
{ data: 'years_in_profession', name: 'years_in_profession' },
{ data: 'email', name: 'email' },
{ data: 'phone_number', name: 'phone_number' },
{ data: 'previous_agency', name: 'previous_agency' },
{ data: 'notes', name: 'notes' },
{ data: 'accuracy', name: 'accuracy' },
{ data: 'signature', name: 'signature' },
{ data: 'initials', name: 'initials' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-PublicOfficial').DataTable(dtOverrideGlobals);
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