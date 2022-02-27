<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyReklamaRequest;
use App\Http\Requests\StoreReklamaRequest;
use App\Http\Requests\UpdateReklamaRequest;
use App\Models\Reklama;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReklamaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('reklama_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reklamas = Reklama::all();

        return view('admin.reklamas.index', compact('reklamas'));
    }

    public function create()
    {
        abort_if(Gate::denies('reklama_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reklamas.create');
    }

    public function store(StoreReklamaRequest $request)
    {
        $reklama = Reklama::create($request->all());

        return redirect()->route('admin.reklamas.index');
    }

    public function edit(Reklama $reklama)
    {
        abort_if(Gate::denies('reklama_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reklamas.edit', compact('reklama'));
    }

    public function update(UpdateReklamaRequest $request, Reklama $reklama)
    {
        $reklama->update($request->all());

        return redirect()->route('admin.reklamas.index');
    }

    public function show(Reklama $reklama)
    {
        abort_if(Gate::denies('reklama_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reklamas.show', compact('reklama'));
    }

    public function destroy(Reklama $reklama)
    {
        abort_if(Gate::denies('reklama_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reklama->delete();

        return back();
    }

    public function massDestroy(MassDestroyReklamaRequest $request)
    {
        Reklama::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
