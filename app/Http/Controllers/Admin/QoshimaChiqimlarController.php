<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyQoshimaChiqimlarRequest;
use App\Http\Requests\StoreQoshimaChiqimlarRequest;
use App\Http\Requests\UpdateQoshimaChiqimlarRequest;
use App\Models\QoshimaChiqimlar;
use App\Models\Worker;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QoshimaChiqimlarController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('qoshima_chiqimlar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qoshimaChiqimlars = QoshimaChiqimlar::with(['kim_tarafidan_olindi'])->get();

        return view('admin.qoshimaChiqimlars.index', compact('qoshimaChiqimlars'));
    }

    public function create()
    {
        abort_if(Gate::denies('qoshima_chiqimlar_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kim_tarafidan_olindis = Worker::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.qoshimaChiqimlars.create', compact('kim_tarafidan_olindis'));
    }

    public function store(StoreQoshimaChiqimlarRequest $request)
    {
        $qoshimaChiqimlar = QoshimaChiqimlar::create($request->all());

        return redirect()->route('admin.qoshima-chiqimlars.index');
    }

    public function edit(QoshimaChiqimlar $qoshimaChiqimlar)
    {
        abort_if(Gate::denies('qoshima_chiqimlar_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kim_tarafidan_olindis = Worker::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $qoshimaChiqimlar->load('kim_tarafidan_olindi');

        return view('admin.qoshimaChiqimlars.edit', compact('kim_tarafidan_olindis', 'qoshimaChiqimlar'));
    }

    public function update(UpdateQoshimaChiqimlarRequest $request, QoshimaChiqimlar $qoshimaChiqimlar)
    {
        $qoshimaChiqimlar->update($request->all());

        return redirect()->route('admin.qoshima-chiqimlars.index');
    }

    public function show(QoshimaChiqimlar $qoshimaChiqimlar)
    {
        abort_if(Gate::denies('qoshima_chiqimlar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qoshimaChiqimlar->load('kim_tarafidan_olindi');

        return view('admin.qoshimaChiqimlars.show', compact('qoshimaChiqimlar'));
    }

    public function destroy(QoshimaChiqimlar $qoshimaChiqimlar)
    {
        abort_if(Gate::denies('qoshima_chiqimlar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qoshimaChiqimlar->delete();

        return back();
    }

    public function massDestroy(MassDestroyQoshimaChiqimlarRequest $request)
    {
        QoshimaChiqimlar::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
