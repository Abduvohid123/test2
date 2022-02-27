<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKashalokRequest;
use App\Http\Requests\UpdateKashalokRequest;
use App\Http\Resources\Admin\KashalokResource;
use App\Models\Kashalok;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KashalokApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('kashalok_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KashalokResource(Kashalok::with(['user', 'filial'])->get());
    }

    public function store(StoreKashalokRequest $request)
    {
        $kashalok = Kashalok::create($request->all());

        return (new KashalokResource($kashalok))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Kashalok $kashalok)
    {
        abort_if(Gate::denies('kashalok_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KashalokResource($kashalok->load(['user', 'filial']));
    }

    public function update(UpdateKashalokRequest $request, Kashalok $kashalok)
    {
        $kashalok->update($request->all());

        return (new KashalokResource($kashalok))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Kashalok $kashalok)
    {
        abort_if(Gate::denies('kashalok_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kashalok->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
