<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReklamaRequest;
use App\Http\Requests\UpdateReklamaRequest;
use App\Http\Resources\Admin\ReklamaResource;
use App\Models\Reklama;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReklamaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('reklama_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReklamaResource(Reklama::all());
    }

    public function store(StoreReklamaRequest $request)
    {
        $reklama = Reklama::create($request->all());

        return (new ReklamaResource($reklama))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Reklama $reklama)
    {
        abort_if(Gate::denies('reklama_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReklamaResource($reklama);
    }

    public function update(UpdateReklamaRequest $request, Reklama $reklama)
    {
        $reklama->update($request->all());

        return (new ReklamaResource($reklama))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Reklama $reklama)
    {
        abort_if(Gate::denies('reklama_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reklama->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
