<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProgolSystemRequest;
use App\Http\Requests\StoreProgolSystemRequest;
use App\Http\Requests\UpdateProgolSystemRequest;
use App\Models\Group;
use App\Models\ProgolSystem;
use App\Models\Student;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProgolSystemController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('progol_system_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $progolSystems = ProgolSystem::with(['group', 'student'])->get();

        return view('admin.progolSystems.index', compact('progolSystems'));
    }

    public function create()
    {
        abort_if(Gate::denies('progol_system_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $groups = Group::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = Student::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.progolSystems.create', compact('groups', 'students'));
    }

    public function store(StoreProgolSystemRequest $request)
    {
        $progolSystem = ProgolSystem::create($request->all());

        return redirect()->route('admin.progol-systems.index');
    }

    public function edit(ProgolSystem $progolSystem)
    {
        abort_if(Gate::denies('progol_system_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $groups = Group::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = Student::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $progolSystem->load('group', 'student');

        return view('admin.progolSystems.edit', compact('groups', 'progolSystem', 'students'));
    }

    public function update(UpdateProgolSystemRequest $request, ProgolSystem $progolSystem)
    {
        $progolSystem->update($request->all());

        return redirect()->route('admin.progol-systems.index');
    }

    public function show(ProgolSystem $progolSystem)
    {
        abort_if(Gate::denies('progol_system_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $progolSystem->load('group', 'student');

        return view('admin.progolSystems.show', compact('progolSystem'));
    }

    public function destroy(ProgolSystem $progolSystem)
    {
        abort_if(Gate::denies('progol_system_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $progolSystem->delete();

        return back();
    }

    public function massDestroy(MassDestroyProgolSystemRequest $request)
    {
        ProgolSystem::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
