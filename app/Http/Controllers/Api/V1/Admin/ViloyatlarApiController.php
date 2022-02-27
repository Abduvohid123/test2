<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreViloyatlarRequest;
use App\Http\Requests\UpdateViloyatlarRequest;
use App\Http\Resources\Admin\ViloyatlarResource;
use App\Models\Viloyatlar;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ViloyatlarApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('viloyatlar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ViloyatlarResource(Viloyatlar::all());
    }

    public function store(StoreViloyatlarRequest $request)
    {
        $viloyatlar = Viloyatlar::create($request->all());

        return (new ViloyatlarResource($viloyatlar))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Viloyatlar $viloyatlar)
    {
        abort_if(Gate::denies('viloyatlar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ViloyatlarResource($viloyatlar);
    }

    public function update(UpdateViloyatlarRequest $request, Viloyatlar $viloyatlar)
    {
        $viloyatlar->update($request->all());

        return (new ViloyatlarResource($viloyatlar))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Viloyatlar $viloyatlar)
    {
        abort_if(Gate::denies('viloyatlar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $viloyatlar->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
