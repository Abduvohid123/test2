@extends('layouts.admin')
@section('content')
@can('group_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.groups.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.group.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.group.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Group">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.group.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.group.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.group.fields.room') }}
                        </th>
                        <th>
                            {{ trans('cruds.group.fields.fan') }}
                        </th>
                        <th>
                            {{ trans('cruds.group.fields.cost') }}
                        </th>
                        <th>
                            {{ trans('cruds.group.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.group.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.group.fields.start') }}
                        </th>
                        <th>
                            {{ trans('cruds.group.fields.finish') }}
                        </th>
                        <th>
                            {{ trans('cruds.group.fields.days') }}
                        </th>
                        <th>
                            {{ trans('cruds.group.fields.start_cource') }}
                        </th>
                        <th>
                            {{ trans('cruds.group.fields.filial') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($groups as $key => $group)
                        <tr data-entry-id="{{ $group->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $group->id ?? '' }}
                            </td>
                            <td>
                                {{ $group->name ?? '' }}
                            </td>
                            <td>
                                {{ $group->room->name ?? '' }}
                            </td>
                            <td>
                                {{ $group->fan->name ?? '' }}
                            </td>
                            <td>
                                {{ $group->cost ?? '' }}
                            </td>
                            <td>
                                {{ $group->description ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Group::STATUS_SELECT[$group->status] ?? '' }}
                            </td>
                            <td>
                                {{ $group->start ?? '' }}
                            </td>
                            <td>
                                {{ $group->finish ?? '' }}
                            </td>
                            <td>
                                @foreach($group->days as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $group->start_cource ?? '' }}
                            </td>
                            <td>
                                {{ $group->filial->name ?? '' }}
                            </td>
                            <td>
                                @can('group_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.groups.show', $group->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('group_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.groups.edit', $group->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('group_delete')
                                    <form action="{{ route('admin.groups.destroy', $group->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('group_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.groups.massDestroy') }}",
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
    order: [[ 2, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Group:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection