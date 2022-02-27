<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAddTeacheToGroupRequest;
use App\Http\Requests\StoreAddTeacheToGroupRequest;
use App\Http\Requests\UpdateAddTeacheToGroupRequest;
use App\Models\AddTeacheToGroup;
use App\Models\Group;
use App\Models\Worker;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddTeacheToGroupController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('add_teache_to_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addTeacheToGroups = AddTeacheToGroup::with(['group', 'teachers'])->get();

        return view('admin.addTeacheToGroups.index', compact('addTeacheToGroups'));
    }

    public function create()
    {
        abort_if(Gate::denies('add_teache_to_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $groups = Group::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $teachers = Worker::pluck('name', 'id');

        return view('admin.addTeacheToGroups.create', compact('groups', 'teachers'));
    }

    public function store(StoreAddTeacheToGroupRequest $request)
    {
        $addTeacheToGroup = AddTeacheToGroup::create($request->all());
        $addTeacheToGroup->teachers()->sync($request->input('teachers', []));

        return redirect()->route('admin.add-teache-to-groups.index');
    }

    public function edit(AddTeacheToGroup $addTeacheToGroup)
    {
        abort_if(Gate::denies('add_teache_to_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $groups = Group::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $teachers = Worker::pluck('name', 'id');

        $addTeacheToGroup->load('group', 'teachers');

        return view('admin.addTeacheToGroups.edit', compact('addTeacheToGroup', 'groups', 'teachers'));
    }

    public function update(UpdateAddTeacheToGroupRequest $request, AddTeacheToGroup $addTeacheToGroup)
    {
        $addTeacheToGroup->update($request->all());
        $addTeacheToGroup->teachers()->sync($request->input('teachers', []));

        return redirect()->route('admin.add-teache-to-groups.index');
    }

    public function show(AddTeacheToGroup $addTeacheToGroup)
    {
        abort_if(Gate::denies('add_teache_to_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addTeacheToGroup->load('group', 'teachers');

        return view('admin.addTeacheToGroups.show', compact('addTeacheToGroup'));
    }

    public function destroy(AddTeacheToGroup $addTeacheToGroup)
    {
        abort_if(Gate::denies('add_teache_to_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addTeacheToGroup->delete();

        return back();
    }

    public function massDestroy(MassDestroyAddTeacheToGroupRequest $request)
    {
        AddTeacheToGroup::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
