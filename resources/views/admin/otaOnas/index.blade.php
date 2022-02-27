@extends('layouts.admin')
@section('content')
@can('ota_ona_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.ota-onas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.otaOna.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.otaOna.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-OtaOna">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.otaOna.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.otaOna.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.otaOna.fields.student') }}
                        </th>
                        <th>
                            {{ trans('cruds.otaOna.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.otaOna.fields.phone_number') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($otaOnas as $key => $otaOna)
                        <tr data-entry-id="{{ $otaOna->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $otaOna->id ?? '' }}
                            </td>
                            <td>
                                {{ $otaOna->name ?? '' }}
                            </td>
                            <td>
                                {{ $otaOna->student->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\OtaOna::STATUS_SELECT[$otaOna->status] ?? '' }}
                            </td>
                            <td>
                                {{ $otaOna->phone_number ?? '' }}
                            </td>
                            <td>
                                @can('ota_ona_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.ota-onas.show', $otaOna->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('ota_ona_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.ota-onas.edit', $otaOna->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('ota_ona_delete')
                                    <form action="{{ route('admin.ota-onas.destroy', $otaOna->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('ota_ona_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.ota-onas.massDestroy') }}",
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
  let table = $('.datatable-OtaOna:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection