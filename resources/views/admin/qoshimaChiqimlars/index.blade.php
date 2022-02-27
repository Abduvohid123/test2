@extends('layouts.admin')
@section('content')
@can('qoshima_chiqimlar_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.qoshima-chiqimlars.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.qoshimaChiqimlar.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.qoshimaChiqimlar.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-QoshimaChiqimlar">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.qoshimaChiqimlar.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.qoshimaChiqimlar.fields.chiqim_sababi') }}
                        </th>
                        <th>
                            {{ trans('cruds.qoshimaChiqimlar.fields.summa') }}
                        </th>
                        <th>
                            {{ trans('cruds.qoshimaChiqimlar.fields.kim_tarafidan_olindi') }}
                        </th>
                        <th>
                            {{ trans('cruds.qoshimaChiqimlar.fields.filial') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($qoshimaChiqimlars as $key => $qoshimaChiqimlar)
                        <tr data-entry-id="{{ $qoshimaChiqimlar->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $qoshimaChiqimlar->id ?? '' }}
                            </td>
                            <td>
                                {{ $qoshimaChiqimlar->chiqim_sababi ?? '' }}
                            </td>
                            <td>
                                {{ $qoshimaChiqimlar->summa ?? '' }}
                            </td>
                            <td>
                                {{ $qoshimaChiqimlar->kim_tarafidan_olindi->name ?? '' }}
                            </td>
                            <td>
                                {{ $qoshimaChiqimlar->filial->name ?? '' }}
                            </td>
                            <td>
                                @can('qoshima_chiqimlar_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.qoshima-chiqimlars.show', $qoshimaChiqimlar->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('qoshima_chiqimlar_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.qoshima-chiqimlars.edit', $qoshimaChiqimlar->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('qoshima_chiqimlar_delete')
                                    <form action="{{ route('admin.qoshima-chiqimlars.destroy', $qoshimaChiqimlar->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('qoshima_chiqimlar_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.qoshima-chiqimlars.massDestroy') }}",
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
  let table = $('.datatable-QoshimaChiqimlar:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection