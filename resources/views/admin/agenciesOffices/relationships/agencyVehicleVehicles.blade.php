@can('vehicle_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.vehicles.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.vehicle.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.vehicle.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-agencyVehicleVehicles">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.vehicle.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.vehicle.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.vehicle.fields.gtnn_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.vehicle.fields.agency_vehicle') }}
                        </th>
                        <th>
                            {{ trans('cruds.vehicle.fields.year') }}
                        </th>
                        <th>
                            {{ trans('cruds.vehicle.fields.make') }}
                        </th>
                        <th>
                            {{ trans('cruds.vehicle.fields.model') }}
                        </th>
                        <th>
                            {{ trans('cruds.vehicle.fields.marked') }}
                        </th>
                        <th>
                            {{ trans('cruds.vehicle.fields.style') }}
                        </th>
                        <th>
                            {{ trans('cruds.vehicle.fields.condition') }}
                        </th>
                        <th>
                            {{ trans('cruds.vehicle.fields.plate_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.vehicle.fields.vehicle_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.vehicle.fields.notes') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vehicles as $key => $vehicle)
                        <tr data-entry-id="{{ $vehicle->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $vehicle->id ?? '' }}
                            </td>
                            <td>
                                @foreach($vehicle->image as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl('thumb') }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $vehicle->gtnn_number->gtnn_number ?? '' }}
                            </td>
                            <td>
                                {{ $vehicle->agency_vehicle->agency_name ?? '' }}
                            </td>
                            <td>
                                {{ $vehicle->year ?? '' }}
                            </td>
                            <td>
                                {{ $vehicle->make ?? '' }}
                            </td>
                            <td>
                                {{ $vehicle->model ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Vehicle::MARKED_SELECT[$vehicle->marked] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Vehicle::STYLE_SELECT[$vehicle->style] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Vehicle::CONDITION_SELECT[$vehicle->condition] ?? '' }}
                            </td>
                            <td>
                                {{ $vehicle->plate_number ?? '' }}
                            </td>
                            <td>
                                {{ $vehicle->vehicle_number ?? '' }}
                            </td>
                            <td>
                                {{ $vehicle->notes ?? '' }}
                            </td>
                            <td>
                                @can('vehicle_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.vehicles.show', $vehicle->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('vehicle_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.vehicles.edit', $vehicle->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('vehicle_delete')
                                    <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('vehicle_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.vehicles.massDestroy') }}",
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
  let table = $('.datatable-agencyVehicleVehicles:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection