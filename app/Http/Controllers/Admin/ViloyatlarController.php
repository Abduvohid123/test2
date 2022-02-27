<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyViloyatlarRequest;
use App\Http\Requests\StoreViloyatlarRequest;
use App\Http\Requests\UpdateViloyatlarRequest;
use App\Models\Viloyatlar;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ViloyatlarController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('viloyatlar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $viloyatlars = Viloyatlar::all();

        return view('admin.viloyatlars.index', compact('viloyatlars'));
    }

    public function create()
    {
        abort_if(Gate::denies('viloyatlar_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.viloyatlars.create');
    }

    public function store(StoreViloyatlarRequest $request)
    {
        $viloyatlar = Viloyatlar::create($request->all());

        return redirect()->route('admin.viloyatlars.index');
    }

    public function edit(Viloyatlar $viloyatlar)
    {
        abort_if(Gate::denies('viloyatlar_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.viloyatlars.edit', compact('viloyatlar'));
    }

    public function update(UpdateViloyatlarRequest $request, Viloyatlar $viloyatlar)
    {
        $viloyatlar->update($request->all());

        return redirect()->route('admin.viloyatlars.index');
    }

    public function show(Viloyatlar $viloyatlar)
    {
        abort_if(Gate::denies('viloyatlar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.viloyatlars.show', compact('viloyatlar'));
    }

    public function destroy(Viloyatlar $viloyatlar)
    {
        abort_if(Gate::denies('viloyatlar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $viloyatlar->delete();

        return back();
    }

    public function massDestroy(MassDestroyViloyatlarRequest $request)
    {
        Viloyatlar::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
