<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPositionRequest;
use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Models\Filial;
use App\Models\Position;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PositionsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('position_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $positions = Position::with(['filial'])->get();

        return view('admin.positions.index', compact('positions'));
    }

    public function create()
    {
        abort_if(Gate::denies('position_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $filials = Filial::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.positions.create', compact('filials'));
    }

    public function store(StorePositionRequest $request)
    {
        $position = Position::create($request->all());

        return redirect()->route('admin.positions.index');
    }

    public function edit(Position $position)
    {
        abort_if(Gate::denies('position_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $filials = Filial::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $position->load('filial');

        return view('admin.positions.edit', compact('filials', 'position'));
    }

    public function update(UpdatePositionRequest $request, Position $position)
    {
        $position->update($request->all());

        return redirect()->route('admin.positions.index');
    }

    public function show(Position $position)
    {
        abort_if(Gate::denies('position_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $position->load('filial');

        return view('admin.positions.show', compact('position'));
    }

    public function destroy(Position $position)
    {
        abort_if(Gate::denies('position_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $position->delete();

        return back();
    }

    public function massDestroy(MassDestroyPositionRequest $request)
    {
        Position::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
