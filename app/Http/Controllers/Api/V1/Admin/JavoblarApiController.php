<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreJavoblarRequest;
use App\Http\Requests\UpdateJavoblarRequest;
use App\Http\Resources\Admin\JavoblarResource;
use App\Models\Javoblar;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JavoblarApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('javoblar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JavoblarResource(Javoblar::with(['savol', 'filial'])->get());
    }

    public function store(StoreJavoblarRequest $request)
    {
        $javoblar = Javoblar::create($request->all());

        return (new JavoblarResource($javoblar))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Javoblar $javoblar)
    {
        abort_if(Gate::denies('javoblar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JavoblarResource($javoblar->load(['savol', 'filial']));
    }

    public function update(UpdateJavoblarRequest $request, Javoblar $javoblar)
    {
        $javoblar->update($request->all());

        return (new JavoblarResource($javoblar))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Javoblar $javoblar)
    {
        abort_if(Gate::denies('javoblar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $javoblar->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
