<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySavolTypeRequest;
use App\Http\Requests\StoreSavolTypeRequest;
use App\Http\Requests\UpdateSavolTypeRequest;
use App\Models\SavolType;
use App\Models\Sorovnoma;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SavolTypeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('savol_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $savolTypes = SavolType::with(['sorovnoma'])->get();

        return view('admin.savolTypes.index', compact('savolTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('savol_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sorovnomas = Sorovnoma::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.savolTypes.create', compact('sorovnomas'));
    }

    public function store(StoreSavolTypeRequest $request)
    {
        $savolType = SavolType::create($request->all());

        return redirect()->route('admin.savol-types.index');
    }

    public function edit(SavolType $savolType)
    {
        abort_if(Gate::denies('savol_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sorovnomas = Sorovnoma::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $savolType->load('sorovnoma');

        return view('admin.savolTypes.edit', compact('savolType', 'sorovnomas'));
    }

    public function update(UpdateSavolTypeRequest $request, SavolType $savolType)
    {
        $savolType->update($request->all());

        return redirect()->route('admin.savol-types.index');
    }

    public function show(SavolType $savolType)
    {
        abort_if(Gate::denies('savol_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $savolType->load('sorovnoma');

        return view('admin.savolTypes.show', compact('savolType'));
    }

    public function destroy(SavolType $savolType)
    {
        abort_if(Gate::denies('savol_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $savolType->delete();

        return back();
    }

    public function massDestroy(MassDestroySavolTypeRequest $request)
    {
        SavolType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
