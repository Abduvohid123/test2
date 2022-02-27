<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFanRequest;
use App\Http\Requests\UpdateFanRequest;
use App\Http\Resources\Admin\FanResource;
use App\Models\Fan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FanApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('fan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FanResource(Fan::all());
    }

    public function store(StoreFanRequest $request)
    {
        $fan = Fan::create($request->all());

        return (new FanResource($fan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Fan $fan)
    {
        abort_if(Gate::denies('fan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FanResource($fan);
    }

    public function update(UpdateFanRequest $request, Fan $fan)
    {
        $fan->update($request->all());

        return (new FanResource($fan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Fan $fan)
    {
        abort_if(Gate::denies('fan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
