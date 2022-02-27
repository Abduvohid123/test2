<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyKashalokRequest;
use App\Http\Requests\StoreKashalokRequest;
use App\Http\Requests\UpdateKashalokRequest;
use App\Models\Kashalok;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KashalokController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('kashalok_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kashaloks = Kashalok::with(['user'])->get();

        return view('admin.kashaloks.index', compact('kashaloks'));
    }

    public function create()
    {
        abort_if(Gate::denies('kashalok_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.kashaloks.create', compact('users'));
    }

    public function store(StoreKashalokRequest $request)
    {
        $kashalok = Kashalok::create($request->all());

        return redirect()->route('admin.kashaloks.index');
    }

    public function edit(Kashalok $kashalok)
    {
        abort_if(Gate::denies('kashalok_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kashalok->load('user');

        return view('admin.kashaloks.edit', compact('kashalok', 'users'));
    }

    public function update(UpdateKashalokRequest $request, Kashalok $kashalok)
    {
        $kashalok->update($request->all());

        return redirect()->route('admin.kashaloks.index');
    }

    public function show(Kashalok $kashalok)
    {
        abort_if(Gate::denies('kashalok_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kashalok->load('user');

        return view('admin.kashaloks.show', compact('kashalok'));
    }

    public function destroy(Kashalok $kashalok)
    {
        abort_if(Gate::denies('kashalok_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kashalok->delete();

        return back();
    }

    public function massDestroy(MassDestroyKashalokRequest $request)
    {
        Kashalok::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
