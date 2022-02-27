@extends('layouts.admin')
@section('content')
@can('tolovlar_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.tolovlars.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.tolovlar.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.tolovlar.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Tolovlar">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.tolovlar.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.tolovlar.fields.group') }}
                        </th>
                        <th>
                            {{ trans('cruds.tolovlar.fields.student') }}
                        </th>
                        <th>
                            {{ trans('cruds.tolovlar.fields.year') }}
                        </th>
                        <th>
                            {{ trans('cruds.tolovlar.fields.month') }}
                        </th>
                        <th>
                            {{ trans('cruds.tolovlar.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.tolovlar.fields.summa') }}
                        </th>
                        <th>
                            {{ trans('cruds.tolovlar.fields.chegirma') }}
                        </th>
                        <th>
                            {{ trans('cruds.tolovlar.fields.tolov_turi') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tolovlars as $key => $tolovlar)
                        <tr data-entry-id="{{ $tolovlar->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $tolovlar->id ?? '' }}
                            </td>
                            <td>
                                {{ $tolovlar->group->name ?? '' }}
                            </td>
                            <td>
                                {{ $tolovlar->student->name ?? '' }}
                            </td>
                            <td>
                                {{ $tolovlar->year ?? '' }}
                            </td>
                            <td>
                                {{ $tolovlar->month->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Tolovlar::STATUS_SELECT[$tolovlar->status] ?? '' }}
                            </td>
                            <td>
                                {{ $tolovlar->summa ?? '' }}
                            </td>
                            <td>
                                {{ $tolovlar->chegirma ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Tolovlar::TOLOV_TURI_SELECT[$tolovlar->tolov_turi] ?? '' }}
                            </td>
                            <td>
                                @can('tolovlar_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.tolovlars.show', $tolovlar->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('tolovlar_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.tolovlars.edit', $tolovlar->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('tolovlar_delete')
                                    <form action="{{ route('admin.tolovlars.destroy', $tolovlar->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('tolovlar_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tolovlars.massDestroy') }}",
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
  let table = $('.datatable-Tolovlar:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection