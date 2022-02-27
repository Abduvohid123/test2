<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyWorkerRequest;
use App\Http\Requests\StoreWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
use App\Models\Position;
use App\Models\User;
use App\Models\Worker;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class WorkersController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('worker_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workers = Worker::with(['position', 'user', 'media'])->get();

        return view('admin.workers.index', compact('workers'));
    }

    public function create()
    {
        abort_if(Gate::denies('worker_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $positions = Position::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.workers.create', compact('positions', 'users'));
    }

    public function store(StoreWorkerRequest $request)
    {
        $worker = Worker::create($request->all());

        if ($request->input('image', false)) {
            $worker->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $worker->id]);
        }

        return redirect()->route('admin.workers.index');
    }

    public function edit(Worker $worker)
    {
        abort_if(Gate::denies('worker_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $positions = Position::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $worker->load('position', 'user');

        return view('admin.workers.edit', compact('positions', 'users', 'worker'));
    }

    public function update(UpdateWorkerRequest $request, Worker $worker)
    {
        $worker->update($request->all());

        if ($request->input('image', false)) {
            if (!$worker->image || $request->input('image') !== $worker->image->file_name) {
                if ($worker->image) {
                    $worker->image->delete();
                }
                $worker->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($worker->image) {
            $worker->image->delete();
        }

        return redirect()->route('admin.workers.index');
    }

    public function show(Worker $worker)
    {
        abort_if(Gate::denies('worker_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $worker->load('position', 'user');

        return view('admin.workers.show', compact('worker'));
    }

    public function destroy(Worker $worker)
    {
        abort_if(Gate::denies('worker_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $worker->delete();

        return back();
    }

    public function massDestroy(MassDestroyWorkerRequest $request)
    {
        Worker::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('worker_create') && Gate::denies('worker_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Worker();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
