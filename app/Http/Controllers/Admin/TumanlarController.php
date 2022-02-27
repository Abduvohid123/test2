<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTumanlarRequest;
use App\Http\Requests\StoreTumanlarRequest;
use App\Http\Requests\UpdateTumanlarRequest;
use App\Models\Tumanlar;
use App\Models\Viloyatlar;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TumanlarController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tumanlar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tumanlars = Tumanlar::with(['viloyat'])->get();

        return view('admin.tumanlars.index', compact('tumanlars'));
    }

    public function create()
    {
        abort_if(Gate::denies('tumanlar_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $viloyats = Viloyatlar::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.tumanlars.create', compact('viloyats'));
    }

    public function store(StoreTumanlarRequest $request)
    {
        $tumanlar = Tumanlar::create($request->all());

        return redirect()->route('admin.tumanlars.index');
    }

    public function edit(Tumanlar $tumanlar)
    {
        abort_if(Gate::denies('tumanlar_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $viloyats = Viloyatlar::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tumanlar->load('viloyat');

        return view('admin.tumanlars.edit', compact('tumanlar', 'viloyats'));
    }

    public function update(UpdateTumanlarRequest $request, Tumanlar $tumanlar)
    {
        $tumanlar->update($request->all());

        return redirect()->route('admin.tumanlars.index');
    }

    public function show(Tumanlar $tumanlar)
    {
        abort_if(Gate::denies('tumanlar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tumanlar->load('viloyat');

        return view('admin.tumanlars.show', compact('tumanlar'));
    }

    public function destroy(Tumanlar $tumanlar)
    {
        abort_if(Gate::denies('tumanlar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tumanlar->delete();

        return back();
    }

    public function massDestroy(MassDestroyTumanlarRequest $request)
    {
        Tumanlar::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
