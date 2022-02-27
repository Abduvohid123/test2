@extends('layouts.admin')
@section('content')
@can('kashalok_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.kashaloks.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.kashalok.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.kashalok.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Kashalok">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.kashalok.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.kashalok.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.kashalok.fields.summa') }}
                        </th>
                        <th>
                            {{ trans('cruds.kashalok.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kashaloks as $key => $kashalok)
                        <tr data-entry-id="{{ $kashalok->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $kashalok->id ?? '' }}
                            </td>
                            <td>
                                {{ $kashalok->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $kashalok->summa ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Kashalok::STATUS_SELECT[$kashalok->status] ?? '' }}
                            </td>
                            <td>
                                @can('kashalok_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.kashaloks.show', $kashalok->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('kashalok_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.kashaloks.edit', $kashalok->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('kashalok_delete')
                                    <form action="{{ route('admin.kashaloks.destroy', $kashalok->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('kashalok_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.kashaloks.massDestroy') }}",
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
  let table = $('.datatable-Kashalok:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection