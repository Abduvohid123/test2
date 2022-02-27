<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySavollarRequest;
use App\Http\Requests\StoreSavollarRequest;
use App\Http\Requests\UpdateSavollarRequest;
use App\Models\Filial;
use App\Models\Savollar;
use App\Models\SavolType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SavollarController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('savollar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $savollars = Savollar::with(['savol_type', 'filial'])->get();

        return view('admin.savollars.index', compact('savollars'));
    }

    public function create()
    {
        abort_if(Gate::denies('savollar_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $savol_types = SavolType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $filials = Filial::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.savollars.create', compact('filials', 'savol_types'));
    }

    public function store(StoreSavollarRequest $request)
    {
        $savollar = Savollar::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $savollar->id]);
        }

        return redirect()->route('admin.savollars.index');
    }

    public function edit(Savollar $savollar)
    {
        abort_if(Gate::denies('savollar_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $savol_types = SavolType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $filials = Filial::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $savollar->load('savol_type', 'filial');

        return view('admin.savollars.edit', compact('filials', 'savol_types', 'savollar'));
    }

    public function update(UpdateSavollarRequest $request, Savollar $savollar)
    {
        $savollar->update($request->all());

        return redirect()->route('admin.savollars.index');
    }

    public function show(Savollar $savollar)
    {
        abort_if(Gate::denies('savollar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $savollar->load('savol_type', 'filial');

        return view('admin.savollars.show', compact('savollar'));
    }

    public function destroy(Savollar $savollar)
    {
        abort_if(Gate::denies('savollar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $savollar->delete();

        return back();
    }

    public function massDestroy(MassDestroySavollarRequest $request)
    {
        Savollar::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('savollar_create') && Gate::denies('savollar_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Savollar();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
