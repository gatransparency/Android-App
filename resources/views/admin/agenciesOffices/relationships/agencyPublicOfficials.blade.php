@can('public_official_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.public-officials.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.publicOfficial.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.publicOfficial.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-agencyPublicOfficials">
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
                </thead>
                <tbody>
                    @foreach($publicOfficials as $key => $publicOfficial)
                        <tr data-entry-id="{{ $publicOfficial->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $publicOfficial->id ?? '' }}
                            </td>
                            <td>
                                @if($publicOfficial->image)
                                    <a href="{{ $publicOfficial->image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $publicOfficial->image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $publicOfficial->agency->agency_name ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficial->public_official_number ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficial->first_name ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficial->middle_name ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficial->last_name ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficial->badge_employee_number ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficial->sex ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficial->rank ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\PublicOfficial::STATUS_SELECT[$publicOfficial->status] ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficial->officer_key_number ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficial->hired ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficial->years_in_profession ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficial->email ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficial->phone_number ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficial->previous_agency ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficial->notes ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficial->accuracy ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficial->signature ?? '' }}
                            </td>
                            <td>
                                {{ $publicOfficial->initials ?? '' }}
                            </td>
                            <td>
                                @can('public_official_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.public-officials.show', $publicOfficial->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('public_official_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.public-officials.edit', $publicOfficial->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('public_official_delete')
                                    <form action="{{ route('admin.public-officials.destroy', $publicOfficial->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('public_official_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.public-officials.massDestroy') }}",
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
  let table = $('.datatable-agencyPublicOfficials:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection