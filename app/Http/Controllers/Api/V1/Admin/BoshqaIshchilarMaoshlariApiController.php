<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBoshqaIshchilarMaoshlariRequest;
use App\Http\Requests\UpdateBoshqaIshchilarMaoshlariRequest;
use App\Http\Resources\Admin\BoshqaIshchilarMaoshlariResource;
use App\Models\BoshqaIshchilarMaoshlari;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BoshqaIshchilarMaoshlariApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('boshqa_ishchilar_maoshlari_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BoshqaIshchilarMaoshlariResource(BoshqaIshchilarMaoshlari::with(['worker', 'filial'])->get());
    }

    public function store(StoreBoshqaIshchilarMaoshlariRequest $request)
    {
        $boshqaIshchilarMaoshlari = BoshqaIshchilarMaoshlari::create($request->all());

        return (new BoshqaIshchilarMaoshlariResource($boshqaIshchilarMaoshlari))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BoshqaIshchilarMaoshlari $boshqaIshchilarMaoshlari)
    {
        abort_if(Gate::denies('boshqa_ishchilar_maoshlari_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BoshqaIshchilarMaoshlariResource($boshqaIshchilarMaoshlari->load(['worker', 'filial']));
    }

    public function update(UpdateBoshqaIshchilarMaoshlariRequest $request, BoshqaIshchilarMaoshlari $boshqaIshchilarMaoshlari)
    {
        $boshqaIshchilarMaoshlari->update($request->all());

        return (new BoshqaIshchilarMaoshlariResource($boshqaIshchilarMaoshlari))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BoshqaIshchilarMaoshlari $boshqaIshchilarMaoshlari)
    {
        abort_if(Gate::denies('boshqa_ishchilar_maoshlari_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boshqaIshchilarMaoshlari->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
