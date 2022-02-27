<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFilialRequest;
use App\Http\Requests\UpdateFilialRequest;
use App\Http\Resources\Admin\FilialResource;
use App\Models\Filial;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FilialApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('filial_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FilialResource(Filial::all());
    }

    public function store(StoreFilialRequest $request)
    {
        $filial = Filial::create($request->all());

        return (new FilialResource($filial))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Filial $filial)
    {
        abort_if(Gate::denies('filial_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FilialResource($filial);
    }

    public function update(UpdateFilialRequest $request, Filial $filial)
    {
        $filial->update($request->all());

        return (new FilialResource($filial))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Filial $filial)
    {
        abort_if(Gate::denies('filial_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $filial->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
