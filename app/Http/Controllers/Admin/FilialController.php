<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFilialRequest;
use App\Http\Requests\StoreFilialRequest;
use App\Http\Requests\UpdateFilialRequest;
use App\Models\Filial;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FilialController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('filial_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $filials = Filial::all();

        return view('admin.filials.index', compact('filials'));
    }

    public function create()
    {
        abort_if(Gate::denies('filial_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.filials.create');
    }

    public function store(StoreFilialRequest $request)
    {
        $filial = Filial::create($request->all());

        return redirect()->route('admin.filials.index');
    }

    public function edit(Filial $filial)
    {
        abort_if(Gate::denies('filial_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.filials.edit', compact('filial'));
    }

    public function update(UpdateFilialRequest $request, Filial $filial)
    {
        $filial->update($request->all());

        return redirect()->route('admin.filials.index');
    }

    public function show(Filial $filial)
    {
        abort_if(Gate::denies('filial_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.filials.show', compact('filial'));
    }

    public function destroy(Filial $filial)
    {
        abort_if(Gate::denies('filial_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $filial->delete();

        return back();
    }

    public function massDestroy(MassDestroyFilialRequest $request)
    {
        Filial::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
