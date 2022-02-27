<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProgolSystemRequest;
use App\Http\Requests\UpdateProgolSystemRequest;
use App\Http\Resources\Admin\ProgolSystemResource;
use App\Models\ProgolSystem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProgolSystemApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('progol_system_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProgolSystemResource(ProgolSystem::with(['group', 'student', 'filial'])->get());
    }

    public function store(StoreProgolSystemRequest $request)
    {
        $progolSystem = ProgolSystem::create($request->all());

        return (new ProgolSystemResource($progolSystem))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ProgolSystem $progolSystem)
    {
        abort_if(Gate::denies('progol_system_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProgolSystemResource($progolSystem->load(['group', 'student', 'filial']));
    }

    public function update(UpdateProgolSystemRequest $request, ProgolSystem $progolSystem)
    {
        $progolSystem->update($request->all());

        return (new ProgolSystemResource($progolSystem))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ProgolSystem $progolSystem)
    {
        abort_if(Gate::denies('progol_system_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $progolSystem->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
