@extends('layouts.admin')
@section('content')
@can('add_teache_to_group_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.add-teache-to-groups.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.addTeacheToGroup.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.addTeacheToGroup.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-AddTeacheToGroup">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.addTeacheToGroup.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.addTeacheToGroup.fields.group') }}
                        </th>
                        <th>
                            {{ trans('cruds.addTeacheToGroup.fields.teacher') }}
                        </th>
                        <th>
                            {{ trans('cruds.addTeacheToGroup.fields.sallary_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.addTeacheToGroup.fields.oylik') }}
                        </th>
                        <th>
                            {{ trans('cruds.addTeacheToGroup.fields.filial') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($addTeacheToGroups as $key => $addTeacheToGroup)
                        <tr data-entry-id="{{ $addTeacheToGroup->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $addTeacheToGroup->id ?? '' }}
                            </td>
                            <td>
                                {{ $addTeacheToGroup->group->name ?? '' }}
                            </td>
                            <td>
                                @foreach($addTeacheToGroup->teachers as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ App\Models\AddTeacheToGroup::SALLARY_TYPE_RADIO[$addTeacheToGroup->sallary_type] ?? '' }}
                            </td>
                            <td>
                                {{ $addTeacheToGroup->oylik ?? '' }}
                            </td>
                            <td>
                                {{ $addTeacheToGroup->filial->name ?? '' }}
                            </td>
                            <td>
                                @can('add_teache_to_group_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.add-teache-to-groups.show', $addTeacheToGroup->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('add_teache_to_group_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.add-teache-to-groups.edit', $addTeacheToGroup->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('add_teache_to_group_delete')
                                    <form action="{{ route('admin.add-teache-to-groups.destroy', $addTeacheToGroup->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('add_teache_to_group_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.add-teache-to-groups.massDestroy') }}",
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
  let table = $('.datatable-AddTeacheToGroup:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection