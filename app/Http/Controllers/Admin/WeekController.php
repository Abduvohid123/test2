<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWeekRequest;
use App\Http\Requests\StoreWeekRequest;
use App\Http\Requests\UpdateWeekRequest;
use App\Models\Week;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WeekController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('week_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $weeks = Week::all();

        return view('admin.weeks.index', compact('weeks'));
    }

    public function create()
    {
        abort_if(Gate::denies('week_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.weeks.create');
    }

    public function store(StoreWeekRequest $request)
    {
        $week = Week::create($request->all());

        return redirect()->route('admin.weeks.index');
    }

    public function edit(Week $week)
    {
        abort_if(Gate::denies('week_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.weeks.edit', compact('week'));
    }

    public function update(UpdateWeekRequest $request, Week $week)
    {
        $week->update($request->all());

        return redirect()->route('admin.weeks.index');
    }

    public function show(Week $week)
    {
        abort_if(Gate::denies('week_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.weeks.show', compact('week'));
    }

    public function destroy(Week $week)
    {
        abort_if(Gate::denies('week_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $week->delete();

        return back();
    }

    public function massDestroy(MassDestroyWeekRequest $request)
    {
        Week::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
