<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOtaOnaRequest;
use App\Http\Requests\StoreOtaOnaRequest;
use App\Http\Requests\UpdateOtaOnaRequest;
use App\Models\Filial;
use App\Models\OtaOna;
use App\Models\Student;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OtaOnaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ota_ona_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $otaOnas = OtaOna::with(['student', 'filial'])->get();

        return view('admin.otaOnas.index', compact('otaOnas'));
    }

    public function create()
    {
        abort_if(Gate::denies('ota_ona_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = Student::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $filials = Filial::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.otaOnas.create', compact('filials', 'students'));
    }

    public function store(StoreOtaOnaRequest $request)
    {
        $otaOna = OtaOna::create($request->all());

        return redirect()->route('admin.ota-onas.index');
    }

    public function edit(OtaOna $otaOna)
    {
        abort_if(Gate::denies('ota_ona_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = Student::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $filials = Filial::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $otaOna->load('student', 'filial');

        return view('admin.otaOnas.edit', compact('filials', 'otaOna', 'students'));
    }

    public function update(UpdateOtaOnaRequest $request, OtaOna $otaOna)
    {
        $otaOna->update($request->all());

        return redirect()->route('admin.ota-onas.index');
    }

    public function show(OtaOna $otaOna)
    {
        abort_if(Gate::denies('ota_ona_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $otaOna->load('student', 'filial');

        return view('admin.otaOnas.show', compact('otaOna'));
    }

    public function destroy(OtaOna $otaOna)
    {
        abort_if(Gate::denies('ota_ona_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $otaOna->delete();

        return back();
    }

    public function massDestroy(MassDestroyOtaOnaRequest $request)
    {
        OtaOna::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
