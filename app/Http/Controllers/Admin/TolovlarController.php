<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTolovlarRequest;
use App\Http\Requests\StoreTolovlarRequest;
use App\Http\Requests\UpdateTolovlarRequest;
use App\Models\Filial;
use App\Models\Group;
use App\Models\Month;
use App\Models\Student;
use App\Models\Tolovlar;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TolovlarController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tolovlar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tolovlars = Tolovlar::with(['group', 'student', 'month', 'filial'])->get();

        return view('admin.tolovlars.index', compact('tolovlars'));
    }

    public function create()
    {
        abort_if(Gate::denies('tolovlar_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $groups = Group::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = Student::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $months = Month::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $filials = Filial::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.tolovlars.create', compact('filials', 'groups', 'months', 'students'));
    }

    public function store(StoreTolovlarRequest $request)
    {
        $tolovlar = Tolovlar::create($request->all());

        return redirect()->route('admin.tolovlars.index');
    }

    public function edit(Tolovlar $tolovlar)
    {
        abort_if(Gate::denies('tolovlar_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $groups = Group::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = Student::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $months = Month::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $filials = Filial::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tolovlar->load('group', 'student', 'month', 'filial');

        return view('admin.tolovlars.edit', compact('filials', 'groups', 'months', 'students', 'tolovlar'));
    }

    public function update(UpdateTolovlarRequest $request, Tolovlar $tolovlar)
    {
        $tolovlar->update($request->all());

        return redirect()->route('admin.tolovlars.index');
    }

    public function show(Tolovlar $tolovlar)
    {
        abort_if(Gate::denies('tolovlar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tolovlar->load('group', 'student', 'month', 'filial');

        return view('admin.tolovlars.show', compact('tolovlar'));
    }

    public function destroy(Tolovlar $tolovlar)
    {
        abort_if(Gate::denies('tolovlar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tolovlar->delete();

        return back();
    }

    public function massDestroy(MassDestroyTolovlarRequest $request)
    {
        Tolovlar::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
