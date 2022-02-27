<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSavolTypeRequest;
use App\Http\Requests\UpdateSavolTypeRequest;
use App\Http\Resources\Admin\SavolTypeResource;
use App\Models\SavolType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SavolTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('savol_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SavolTypeResource(SavolType::with(['sorovnoma', 'filial'])->get());
    }

    public function store(StoreSavolTypeRequest $request)
    {
        $savolType = SavolType::create($request->all());

        return (new SavolTypeResource($savolType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SavolType $savolType)
    {
        abort_if(Gate::denies('savol_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SavolTypeResource($savolType->load(['sorovnoma', 'filial']));
    }

    public function update(UpdateSavolTypeRequest $request, SavolType $savolType)
    {
        $savolType->update($request->all());

        return (new SavolTypeResource($savolType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SavolType $savolType)
    {
        abort_if(Gate::denies('savol_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $savolType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
