<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddTeacheToGroupRequest;
use App\Http\Requests\UpdateAddTeacheToGroupRequest;
use App\Http\Resources\Admin\AddTeacheToGroupResource;
use App\Models\AddTeacheToGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddTeacheToGroupApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('add_teache_to_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AddTeacheToGroupResource(AddTeacheToGroup::with(['group', 'teachers'])->get());
    }

    public function store(StoreAddTeacheToGroupRequest $request)
    {
        $addTeacheToGroup = AddTeacheToGroup::create($request->all());
        $addTeacheToGroup->teachers()->sync($request->input('teachers', []));

        return (new AddTeacheToGroupResource($addTeacheToGroup))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AddTeacheToGroup $addTeacheToGroup)
    {
        abort_if(Gate::denies('add_teache_to_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AddTeacheToGroupResource($addTeacheToGroup->load(['group', 'teachers']));
    }

    public function update(UpdateAddTeacheToGroupRequest $request, AddTeacheToGroup $addTeacheToGroup)
    {
        $addTeacheToGroup->update($request->all());
        $addTeacheToGroup->teachers()->sync($request->input('teachers', []));

        return (new AddTeacheToGroupResource($addTeacheToGroup))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AddTeacheToGroup $addTeacheToGroup)
    {
        abort_if(Gate::denies('add_teache_to_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addTeacheToGroup->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
