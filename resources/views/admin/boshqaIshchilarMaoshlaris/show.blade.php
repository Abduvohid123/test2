@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.boshqaIshchilarMaoshlari.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.boshqa-ishchilar-maoshlaris.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.boshqaIshchilarMaoshlari.fields.id') }}
                        </th>
                        <td>
                            {{ $boshqaIshchilarMaoshlari->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boshqaIshchilarMaoshlari.fields.worker') }}
                        </th>
                        <td>
                            {{ $boshqaIshchilarMaoshlari->worker->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boshqaIshchilarMaoshlari.fields.summa') }}
                        </th>
                        <td>
                            {{ $boshqaIshchilarMaoshlari->summa }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boshqaIshchilarMaoshlari.fields.bonus') }}
                        </th>
                        <td>
                            {{ $boshqaIshchilarMaoshlari->bonus }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boshqaIshchilarMaoshlari.fields.jarima') }}
                        </th>
                        <td>
                            {{ $boshqaIshchilarMaoshlari->jarima }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boshqaIshchilarMaoshlari.fields.filial') }}
                        </th>
                        <td>
                            {{ $boshqaIshchilarMaoshlari->filial->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.boshqa-ishchilar-maoshlaris.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection