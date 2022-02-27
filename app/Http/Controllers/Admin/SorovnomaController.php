<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySorovnomaRequest;
use App\Http\Requests\StoreSorovnomaRequest;
use App\Http\Requests\UpdateSorovnomaRequest;
use App\Models\Sorovnoma;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SorovnomaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sorovnoma_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sorovnomas = Sorovnoma::all();

        return view('admin.sorovnomas.index', compact('sorovnomas'));
    }

    public function create()
    {
        abort_if(Gate::denies('sorovnoma_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sorovnomas.create');
    }

    public function store(StoreSorovnomaRequest $request)
    {
        $sorovnoma = Sorovnoma::create($request->all());

        return redirect()->route('admin.sorovnomas.index');
    }

    public function edit(Sorovnoma $sorovnoma)
    {
        abort_if(Gate::denies('sorovnoma_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sorovnomas.edit', compact('sorovnoma'));
    }

    public function update(UpdateSorovnomaRequest $request, Sorovnoma $sorovnoma)
    {
        $sorovnoma->update($request->all());

        return redirect()->route('admin.sorovnomas.index');
    }

    public function show(Sorovnoma $sorovnoma)
    {
        abort_if(Gate::denies('sorovnoma_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sorovnomas.show', compact('sorovnoma'));
    }

    public function destroy(Sorovnoma $sorovnoma)
    {
        abort_if(Gate::denies('sorovnoma_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sorovnoma->delete();

        return back();
    }

    public function massDestroy(MassDestroySorovnomaRequest $request)
    {
        Sorovnoma::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
