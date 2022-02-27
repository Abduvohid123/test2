@extends('layouts.admin')
@section('content')
@can('savol_type_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.savol-types.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.savolType.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.savolType.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-SavolType">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.savolType.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.savolType.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.savolType.fields.sorovnoma') }}
                        </th>
                        <th>
                            {{ trans('cruds.savolType.fields.filial') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($savolTypes as $key => $savolType)
                        <tr data-entry-id="{{ $savolType->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $savolType->id ?? '' }}
                            </td>
                            <td>
                                {{ $savolType->name ?? '' }}
                            </td>
                            <td>
                                {{ $savolType->sorovnoma->name ?? '' }}
                            </td>
                            <td>
                                {{ $savolType->filial->name ?? '' }}
                            </td>
                            <td>
                                @can('savol_type_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.savol-types.show', $savolType->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('savol_type_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.savol-types.edit', $savolType->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('savol_type_delete')
                                    <form action="{{ route('admin.savol-types.destroy', $savolType->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('savol_type_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.savol-types.massDestroy') }}",
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
  let table = $('.datatable-SavolType:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection