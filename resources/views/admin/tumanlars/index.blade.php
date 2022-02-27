@extends('layouts.admin')
@section('content')
@can('tumanlar_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.tumanlars.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.tumanlar.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.tumanlar.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Tumanlar">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.tumanlar.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.tumanlar.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.tumanlar.fields.viloyat') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tumanlars as $key => $tumanlar)
                        <tr data-entry-id="{{ $tumanlar->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $tumanlar->id ?? '' }}
                            </td>
                            <td>
                                {{ $tumanlar->name ?? '' }}
                            </td>
                            <td>
                                {{ $tumanlar->viloyat->name ?? '' }}
                            </td>
                            <td>
                                @can('tumanlar_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.tumanlars.show', $tumanlar->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('tumanlar_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.tumanlars.edit', $tumanlar->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('tumanlar_delete')
                                    <form action="{{ route('admin.tumanlars.destroy', $tumanlar->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('tumanlar_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tumanlars.massDestroy') }}",
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
  let table = $('.datatable-Tumanlar:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection