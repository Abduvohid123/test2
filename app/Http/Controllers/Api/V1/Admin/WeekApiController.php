<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWeekRequest;
use App\Http\Requests\UpdateWeekRequest;
use App\Http\Resources\Admin\WeekResource;
use App\Models\Week;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WeekApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('week_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WeekResource(Week::all());
    }

    public function store(StoreWeekRequest $request)
    {
        $week = Week::create($request->all());

        return (new WeekResource($week))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Week $week)
    {
        abort_if(Gate::denies('week_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WeekResource($week);
    }

    public function update(UpdateWeekRequest $request, Week $week)
    {
        $week->update($request->all());

        return (new WeekResource($week))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Week $week)
    {
        abort_if(Gate::denies('week_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $week->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
