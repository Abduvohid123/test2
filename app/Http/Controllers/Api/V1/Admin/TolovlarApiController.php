<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTolovlarRequest;
use App\Http\Requests\UpdateTolovlarRequest;
use App\Http\Resources\Admin\TolovlarResource;
use App\Models\Tolovlar;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TolovlarApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tolovlar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TolovlarResource(Tolovlar::with(['group', 'student', 'month', 'filial'])->get());
    }

    public function store(StoreTolovlarRequest $request)
    {
        $tolovlar = Tolovlar::create($request->all());

        return (new TolovlarResource($tolovlar))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Tolovlar $tolovlar)
    {
        abort_if(Gate::denies('tolovlar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TolovlarResource($tolovlar->load(['group', 'student', 'month', 'filial']));
    }

    public function update(UpdateTolovlarRequest $request, Tolovlar $tolovlar)
    {
        $tolovlar->update($request->all());

        return (new TolovlarResource($tolovlar))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Tolovlar $tolovlar)
    {
        abort_if(Gate::denies('tolovlar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tolovlar->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
