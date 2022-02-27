<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQoshimaChiqimlarRequest;
use App\Http\Requests\UpdateQoshimaChiqimlarRequest;
use App\Http\Resources\Admin\QoshimaChiqimlarResource;
use App\Models\QoshimaChiqimlar;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QoshimaChiqimlarApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('qoshima_chiqimlar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new QoshimaChiqimlarResource(QoshimaChiqimlar::with(['kim_tarafidan_olindi'])->get());
    }

    public function store(StoreQoshimaChiqimlarRequest $request)
    {
        $qoshimaChiqimlar = QoshimaChiqimlar::create($request->all());

        return (new QoshimaChiqimlarResource($qoshimaChiqimlar))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(QoshimaChiqimlar $qoshimaChiqimlar)
    {
        abort_if(Gate::denies('qoshima_chiqimlar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new QoshimaChiqimlarResource($qoshimaChiqimlar->load(['kim_tarafidan_olindi']));
    }

    public function update(UpdateQoshimaChiqimlarRequest $request, QoshimaChiqimlar $qoshimaChiqimlar)
    {
        $qoshimaChiqimlar->update($request->all());

        return (new QoshimaChiqimlarResource($qoshimaChiqimlar))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(QoshimaChiqimlar $qoshimaChiqimlar)
    {
        abort_if(Gate::denies('qoshima_chiqimlar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qoshimaChiqimlar->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
