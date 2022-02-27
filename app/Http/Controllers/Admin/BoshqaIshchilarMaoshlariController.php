<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBoshqaIshchilarMaoshlariRequest;
use App\Http\Requests\StoreBoshqaIshchilarMaoshlariRequest;
use App\Http\Requests\UpdateBoshqaIshchilarMaoshlariRequest;
use App\Models\BoshqaIshchilarMaoshlari;
use App\Models\Worker;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BoshqaIshchilarMaoshlariController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('boshqa_ishchilar_maoshlari_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boshqaIshchilarMaoshlaris = BoshqaIshchilarMaoshlari::with(['worker'])->get();

        return view('admin.boshqaIshchilarMaoshlaris.index', compact('boshqaIshchilarMaoshlaris'));
    }

    public function create()
    {
        abort_if(Gate::denies('boshqa_ishchilar_maoshlari_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workers = Worker::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.boshqaIshchilarMaoshlaris.create', compact('workers'));
    }

    public function store(StoreBoshqaIshchilarMaoshlariRequest $request)
    {
        $boshqaIshchilarMaoshlari = BoshqaIshchilarMaoshlari::create($request->all());

        return redirect()->route('admin.boshqa-ishchilar-maoshlaris.index');
    }

    public function edit(BoshqaIshchilarMaoshlari $boshqaIshchilarMaoshlari)
    {
        abort_if(Gate::denies('boshqa_ishchilar_maoshlari_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workers = Worker::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boshqaIshchilarMaoshlari->load('worker');

        return view('admin.boshqaIshchilarMaoshlaris.edit', compact('boshqaIshchilarMaoshlari', 'workers'));
    }

    public function update(UpdateBoshqaIshchilarMaoshlariRequest $request, BoshqaIshchilarMaoshlari $boshqaIshchilarMaoshlari)
    {
        $boshqaIshchilarMaoshlari->update($request->all());

        return redirect()->route('admin.boshqa-ishchilar-maoshlaris.index');
    }

    public function show(BoshqaIshchilarMaoshlari $boshqaIshchilarMaoshlari)
    {
        abort_if(Gate::denies('boshqa_ishchilar_maoshlari_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boshqaIshchilarMaoshlari->load('worker');

        return view('admin.boshqaIshchilarMaoshlaris.show', compact('boshqaIshchilarMaoshlari'));
    }

    public function destroy(BoshqaIshchilarMaoshlari $boshqaIshchilarMaoshlari)
    {
        abort_if(Gate::denies('boshqa_ishchilar_maoshlari_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boshqaIshchilarMaoshlari->delete();

        return back();
    }

    public function massDestroy(MassDestroyBoshqaIshchilarMaoshlariRequest $request)
    {
        BoshqaIshchilarMaoshlari::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
