<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMonthRequest;
use App\Http\Requests\UpdateMonthRequest;
use App\Http\Resources\Admin\MonthResource;
use App\Models\Month;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MonthsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('month_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MonthResource(Month::all());
    }

    public function store(StoreMonthRequest $request)
    {
        $month = Month::create($request->all());

        return (new MonthResource($month))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Month $month)
    {
        abort_if(Gate::denies('month_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MonthResource($month);
    }

    public function update(UpdateMonthRequest $request, Month $month)
    {
        $month->update($request->all());

        return (new MonthResource($month))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Month $month)
    {
        abort_if(Gate::denies('month_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $month->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
