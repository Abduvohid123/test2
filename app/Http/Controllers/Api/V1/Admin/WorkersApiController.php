<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
use App\Http\Resources\Admin\WorkerResource;
use App\Models\Worker;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkersApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('worker_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkerResource(Worker::with(['position', 'user'])->get());
    }

    public function store(StoreWorkerRequest $request)
    {
        $worker = Worker::create($request->all());

        if ($request->input('image', false)) {
            $worker->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new WorkerResource($worker))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Worker $worker)
    {
        abort_if(Gate::denies('worker_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkerResource($worker->load(['position', 'user']));
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

        return (new WorkerResource($worker))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Worker $worker)
    {
        abort_if(Gate::denies('worker_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $worker->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
