<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyStudentRequest;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Filial;
use App\Models\Group;
use App\Models\Reklama;
use App\Models\Student;
use App\Models\Tumanlar;
use App\Models\User;
use App\Models\Week;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class StudentsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('student_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = Student::with(['groups', 'weeks', 'tuman', 'reklama', 'user', 'filial', 'media'])->get();

        $groups = Group::get();

        $weeks = Week::get();

        $tumanlars = Tumanlar::get();

        $reklamas = Reklama::get();

        $users = User::get();

        $filials = Filial::get();

        return view('admin.students.index', compact('filials', 'groups', 'reklamas', 'students', 'tumanlars', 'users', 'weeks'));
    }

    public function create()
    {
        abort_if(Gate::denies('student_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $groups = Group::pluck('name', 'id');

        $weeks = Week::pluck('name', 'id');

        $tumen = Tumanlar::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $reklamas = Reklama::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $filials = Filial::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.students.create', compact('filials', 'groups', 'reklamas', 'tumen', 'users', 'weeks'));
    }

    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->all());
        $student->groups()->sync($request->input('groups', []));
        $student->weeks()->sync($request->input('weeks', []));
        if ($request->input('image', false)) {
            $student->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $student->id]);
        }

        return redirect()->route('admin.students.index');
    }

    public function edit(Student $student)
    {
        abort_if(Gate::denies('student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $groups = Group::pluck('name', 'id');

        $weeks = Week::pluck('name', 'id');

        $tumen = Tumanlar::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $reklamas = Reklama::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $filials = Filial::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $student->load('groups', 'weeks', 'tuman', 'reklama', 'user', 'filial');

        return view('admin.students.edit', compact('filials', 'groups', 'reklamas', 'student', 'tumen', 'users', 'weeks'));
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->all());
        $student->groups()->sync($request->input('groups', []));
        $student->weeks()->sync($request->input('weeks', []));
        if ($request->input('image', false)) {
            if (!$student->image || $request->input('image') !== $student->image->file_name) {
                if ($student->image) {
                    $student->image->delete();
                }
                $student->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($student->image) {
            $student->image->delete();
        }

        return redirect()->route('admin.students.index');
    }

    public function show(Student $student)
    {
        abort_if(Gate::denies('student_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student->load('groups', 'weeks', 'tuman', 'reklama', 'user', 'filial');

        return view('admin.students.show', compact('student'));
    }

    public function destroy(Student $student)
    {
        abort_if(Gate::denies('student_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student->delete();

        return back();
    }

    public function massDestroy(MassDestroyStudentRequest $request)
    {
        Student::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('student_create') && Gate::denies('student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Student();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
