<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGroupRequest;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Fan;
use App\Models\Filial;
use App\Models\Group;
use App\Models\Room;
use App\Models\Week;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GroupsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $groups = Group::with(['room', 'fan', 'days', 'filial'])->get();

        return view('admin.groups.index', compact('groups'));
    }

    public function create()
    {
        abort_if(Gate::denies('group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rooms = Room::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $fans = Fan::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $days = Week::pluck('name', 'id');

        $filials = Filial::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.groups.create', compact('days', 'fans', 'filials', 'rooms'));
    }

    public function store(StoreGroupRequest $request)
    {
        $group = Group::create($request->all());
        $group->days()->sync($request->input('days', []));

        return redirect()->route('admin.groups.index');
    }

    public function edit(Group $group)
    {
        abort_if(Gate::denies('group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rooms = Room::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $fans = Fan::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $days = Week::pluck('name', 'id');

        $filials = Filial::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $group->load('room', 'fan', 'days', 'filial');

        return view('admin.groups.edit', compact('days', 'fans', 'filials', 'group', 'rooms'));
    }

    public function update(UpdateGroupRequest $request, Group $group)
    {
        $group->update($request->all());
        $group->days()->sync($request->input('days', []));

        return redirect()->route('admin.groups.index');
    }

    public function show(Group $group)
    {
        abort_if(Gate::denies('group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $group->load('room', 'fan', 'days', 'filial');

        return view('admin.groups.show', compact('group'));
    }

    public function destroy(Group $group)
    {
        abort_if(Gate::denies('group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $group->delete();

        return back();
    }

    public function massDestroy(MassDestroyGroupRequest $request)
    {
        Group::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
