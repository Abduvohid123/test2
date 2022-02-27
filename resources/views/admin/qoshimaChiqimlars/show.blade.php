@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.qoshimaChiqimlar.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.qoshima-chiqimlars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.qoshimaChiqimlar.fields.id') }}
                        </th>
                        <td>
                            {{ $qoshimaChiqimlar->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.qoshimaChiqimlar.fields.chiqim_sababi') }}
                        </th>
                        <td>
                            {{ $qoshimaChiqimlar->chiqim_sababi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.qoshimaChiqimlar.fields.summa') }}
                        </th>
                        <td>
                            {{ $qoshimaChiqimlar->summa }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.qoshimaChiqimlar.fields.kim_tarafidan_olindi') }}
                        </th>
                        <td>
                            {{ $qoshimaChiqimlar->kim_tarafidan_olindi->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.qoshima-chiqimlars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection