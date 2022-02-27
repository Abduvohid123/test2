<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSavollarRequest;
use App\Http\Requests\UpdateSavollarRequest;
use App\Http\Resources\Admin\SavollarResource;
use App\Models\Savollar;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SavollarApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('savollar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SavollarResource(Savollar::with(['savol_type'])->get());
    }

    public function store(StoreSavollarRequest $request)
    {
        $savollar = Savollar::create($request->all());

        return (new SavollarResource($savollar))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Savollar $savollar)
    {
        abort_if(Gate::denies('savollar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SavollarResource($savollar->load(['savol_type']));
    }

    public function update(UpdateSavollarRequest $request, Savollar $savollar)
    {
        $savollar->update($request->all());

        return (new SavollarResource($savollar))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Savollar $savollar)
    {
        abort_if(Gate::denies('savollar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $savollar->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
