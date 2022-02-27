@extends('layouts.admin')
@section('content')
@can('savollar_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.savollars.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.savollar.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.savollar.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Savollar">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.savollar.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.savollar.fields.savol_title') }}
                        </th>
                        <th>
                            {{ trans('cruds.savollar.fields.savol_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.savollar.fields.filial') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($savollars as $key => $savollar)
                        <tr data-entry-id="{{ $savollar->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $savollar->id ?? '' }}
                            </td>
                            <td>
                                {{ $savollar->savol_title ?? '' }}
                            </td>
                            <td>
                                {{ $savollar->savol_type->name ?? '' }}
                            </td>
                            <td>
                                {{ $savollar->filial->name ?? '' }}
                            </td>
                            <td>
                                @can('savollar_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.savollars.show', $savollar->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('savollar_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.savollars.edit', $savollar->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('savollar_delete')
                                    <form action="{{ route('admin.savollars.destroy', $savollar->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('savollar_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.savollars.massDestroy') }}",
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
  let table = $('.datatable-Savollar:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection