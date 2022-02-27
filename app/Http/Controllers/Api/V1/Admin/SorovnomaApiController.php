<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSorovnomaRequest;
use App\Http\Requests\UpdateSorovnomaRequest;
use App\Http\Resources\Admin\SorovnomaResource;
use App\Models\Sorovnoma;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SorovnomaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sorovnoma_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SorovnomaResource(Sorovnoma::with(['filial'])->get());
    }

    public function store(StoreSorovnomaRequest $request)
    {
        $sorovnoma = Sorovnoma::create($request->all());

        return (new SorovnomaResource($sorovnoma))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Sorovnoma $sorovnoma)
    {
        abort_if(Gate::denies('sorovnoma_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SorovnomaResource($sorovnoma->load(['filial']));
    }

    public function update(UpdateSorovnomaRequest $request, Sorovnoma $sorovnoma)
    {
        $sorovnoma->update($request->all());

        return (new SorovnomaResource($sorovnoma))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Sorovnoma $sorovnoma)
    {
        abort_if(Gate::denies('sorovnoma_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sorovnoma->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
