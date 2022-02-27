<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyJavoblarRequest;
use App\Http\Requests\StoreJavoblarRequest;
use App\Http\Requests\UpdateJavoblarRequest;
use App\Models\Javoblar;
use App\Models\Savollar;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class JavoblarController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('javoblar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $javoblars = Javoblar::with(['savol'])->get();

        return view('admin.javoblars.index', compact('javoblars'));
    }

    public function create()
    {
        abort_if(Gate::denies('javoblar_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $savols = Savollar::pluck('savol_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.javoblars.create', compact('savols'));
    }

    public function store(StoreJavoblarRequest $request)
    {
        $javoblar = Javoblar::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $javoblar->id]);
        }

        return redirect()->route('admin.javoblars.index');
    }

    public function edit(Javoblar $javoblar)
    {
        abort_if(Gate::denies('javoblar_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $savols = Savollar::pluck('savol_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $javoblar->load('savol');

        return view('admin.javoblars.edit', compact('javoblar', 'savols'));
    }

    public function update(UpdateJavoblarRequest $request, Javoblar $javoblar)
    {
        $javoblar->update($request->all());

        return redirect()->route('admin.javoblars.index');
    }

    public function show(Javoblar $javoblar)
    {
        abort_if(Gate::denies('javoblar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $javoblar->load('savol');

        return view('admin.javoblars.show', compact('javoblar'));
    }

    public function destroy(Javoblar $javoblar)
    {
        abort_if(Gate::denies('javoblar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $javoblar->delete();

        return back();
    }

    public function massDestroy(MassDestroyJavoblarRequest $request)
    {
        Javoblar::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('javoblar_create') && Gate::denies('javoblar_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Javoblar();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
