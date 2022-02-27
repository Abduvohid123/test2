@extends('layouts.admin')
@section('content')
@can('boshqa_ishchilar_maoshlari_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.boshqa-ishchilar-maoshlaris.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.boshqaIshchilarMaoshlari.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.boshqaIshchilarMaoshlari.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-BoshqaIshchilarMaoshlari">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.boshqaIshchilarMaoshlari.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.boshqaIshchilarMaoshlari.fields.worker') }}
                        </th>
                        <th>
                            {{ trans('cruds.boshqaIshchilarMaoshlari.fields.summa') }}
                        </th>
                        <th>
                            {{ trans('cruds.boshqaIshchilarMaoshlari.fields.bonus') }}
                        </th>
                        <th>
                            {{ trans('cruds.boshqaIshchilarMaoshlari.fields.jarima') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($boshqaIshchilarMaoshlaris as $key => $boshqaIshchilarMaoshlari)
                        <tr data-entry-id="{{ $boshqaIshchilarMaoshlari->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $boshqaIshchilarMaoshlari->id ?? '' }}
                            </td>
                            <td>
                                {{ $boshqaIshchilarMaoshlari->worker->name ?? '' }}
                            </td>
                            <td>
                                {{ $boshqaIshchilarMaoshlari->summa ?? '' }}
                            </td>
                            <td>
                                {{ $boshqaIshchilarMaoshlari->bonus ?? '' }}
                            </td>
                            <td>
                                {{ $boshqaIshchilarMaoshlari->jarima ?? '' }}
                            </td>
                            <td>
                                @can('boshqa_ishchilar_maoshlari_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.boshqa-ishchilar-maoshlaris.show', $boshqaIshchilarMaoshlari->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('boshqa_ishchilar_maoshlari_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.boshqa-ishchilar-maoshlaris.edit', $boshqaIshchilarMaoshlari->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('boshqa_ishchilar_maoshlari_delete')
                                    <form action="{{ route('admin.boshqa-ishchilar-maoshlaris.destroy', $boshqaIshchilarMaoshlari->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('boshqa_ishchilar_maoshlari_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.boshqa-ishchilar-maoshlaris.massDestroy') }}",
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
  let table = $('.datatable-BoshqaIshchilarMaoshlari:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection