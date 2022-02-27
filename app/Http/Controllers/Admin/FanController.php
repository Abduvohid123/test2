<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFanRequest;
use App\Http\Requests\StoreFanRequest;
use App\Http\Requests\UpdateFanRequest;
use App\Models\Fan;
use App\Models\Filial;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FanController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('fan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fans = Fan::with(['filial'])->get();

        return view('admin.fans.index', compact('fans'));
    }

    public function create()
    {
        abort_if(Gate::denies('fan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $filials = Filial::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.fans.create', compact('filials'));
    }

    public function store(StoreFanRequest $request)
    {
        $fan = Fan::create($request->all());

        return redirect()->route('admin.fans.index');
    }

    public function edit(Fan $fan)
    {
        abort_if(Gate::denies('fan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $filials = Filial::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $fan->load('filial');

        return view('admin.fans.edit', compact('fan', 'filials'));
    }

    public function update(UpdateFanRequest $request, Fan $fan)
    {
        $fan->update($request->all());

        return redirect()->route('admin.fans.index');
    }

    public function show(Fan $fan)
    {
        abort_if(Gate::denies('fan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fan->load('filial');

        return view('admin.fans.show', compact('fan'));
    }

    public function destroy(Fan $fan)
    {
        abort_if(Gate::denies('fan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fan->delete();

        return back();
    }

    public function massDestroy(MassDestroyFanRequest $request)
    {
        Fan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
