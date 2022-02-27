<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOtaOnaRequest;
use App\Http\Requests\UpdateOtaOnaRequest;
use App\Http\Resources\Admin\OtaOnaResource;
use App\Models\OtaOna;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OtaOnaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ota_ona_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OtaOnaResource(OtaOna::with(['student', 'filial'])->get());
    }

    public function store(StoreOtaOnaRequest $request)
    {
        $otaOna = OtaOna::create($request->all());

        return (new OtaOnaResource($otaOna))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(OtaOna $otaOna)
    {
        abort_if(Gate::denies('ota_ona_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OtaOnaResource($otaOna->load(['student', 'filial']));
    }

    public function update(UpdateOtaOnaRequest $request, OtaOna $otaOna)
    {
        $otaOna->update($request->all());

        return (new OtaOnaResource($otaOna))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(OtaOna $otaOna)
    {
        abort_if(Gate::denies('ota_ona_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $otaOna->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
