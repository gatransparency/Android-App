@can('bug_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.bugs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.bug.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.bug.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-versionBugs">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.bug.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.bug.fields.version') }}
                        </th>
                        <th>
                            {{ trans('cruds.bug.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.bug.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.bug.fields.synopsis') }}
                        </th>
                        <th>
                            {{ trans('cruds.bug.fields.fixed') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bugs as $key => $bug)
                        <tr data-entry-id="{{ $bug->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $bug->id ?? '' }}
                            </td>
                            <td>
                                {{ $bug->version->portal_version ?? '' }}
                            </td>
                            <td>
                                {{ $bug->title ?? '' }}
                            </td>
                            <td>
                                {{ $bug->status ?? '' }}
                            </td>
                            <td>
                                {{ $bug->synopsis ?? '' }}
                            </td>
                            <td>
                                {{ $bug->fixed ?? '' }}
                            </td>
                            <td>
                                @can('bug_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.bugs.show', $bug->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('bug_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.bugs.edit', $bug->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('bug_delete')
                                    <form action="{{ route('admin.bugs.destroy', $bug->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('bug_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.bugs.massDestroy') }}",
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
  let table = $('.datatable-versionBugs:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection