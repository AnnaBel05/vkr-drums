<?php

namespace App\Http\Controllers;

use App\Models\Excercise;
use App\Models\Media;
use App\Models\StudentCourse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentCourseController extends ExcerciseController
{
    //TODO: СТРАНИЦА ЗАПИСИ СТУДЕНТОМ НА КУРС
    public function index()
    {
        if (Auth::check()) {
            $userid = Auth::id();
            $user = User::where('id', $userid)->first();

            // dd($user->course_id);

            if ($user->course_id != null) {
                $headers = ['Content-Type' => 'application/json; charset=utf-8'];
                $studentcourses = StudentCourse::all();
                $studentcourse = $user->course;
                $professor = User::where('course_id', $studentcourse->id)
                    ->where('role_id', 2)->first();
                $students = User::where('course_id', $studentcourse->id)
                    ->where('role_id', 3)->get();
                $excercises = Excercise::where('student_course_id', $studentcourse->id)->get();

                return view('studentcourses.index', compact('studentcourse', 'excercises', 'professor', 'students'));
            }
            else {
                return view('studentcourses.indexnew');
            }
        } else {
            return view('studentcourses.index-no-login');
        }
    }

    public function upload(Request $request)
    {
    }

    // TODO: create for professors only
    // TODO: sign up with diff roles (not in this class)

    public function create()
    {
        $professor = User::where('role_id',2)->get();

        return view('studentcourses.create', compact('professor'));
    }

    public function store(Request $request)
    {
        $professor = User::where('id', $request->professor_id)->first();
        $studentCourse = $professor->course;

        // $studentCourse = StudentCourse::create($request->all());
        // $studentCourse->update($request->all());

        $studentid = Auth::id();
        $student = User::where('id', $studentid)->first();
        $student->course_id = $studentCourse->id;

        // dd($request);

        $student->update();

        return redirect()->route('studentcourses.index')->with('success', 'Course was created succesfully.');
    }

    public function show()
    {
    }

    public function edit(StudentCourse $studentcourse)
    {
        $media = Media::all();
        $excercise = Excercise::all();


        return view('studentcourses.edit', compact('studentcourse', 'media', 'excercise'));
    }

    public function update(Request $request, StudentCourse $studentcourse)
    {
        $input = $request->all();

        $studentcourse->updated_at = now();

        if ($request->hasFile('media')) {
            $destination_path = 'public/media/course';
            $media = $request->file('media');
            $mediaName = $media->getClientOriginalName();
            $path = $request->file('media')->store($destination_path, 'public');
            // $path = $request->file('media')->storeAs($destination_path,$mediaName);  

            $mediaVal = new Media;
            $mediaVal->name = $mediaName;
            $mediaVal->link = $path;
            $mediaVal->save($request->all());

            $excercise = new Excercise;
            $excercise->media_id = $mediaVal->id;
            $excercise->theory = $request->theory;
            $excercise->student_course_id = $studentcourse->id;
            $excercise->save($request->all());

            // $studentcourse->update($request->all());
            return redirect()->route('studentcourses.index')->with('success', 'Excercise added successfully');
        } else {
            $excercise = new Excercise;
            $excercise->media_id = null;
            $excercise->theory = $request->theory;
            $excercise->student_course_id = $studentcourse->id;
            $excercise->save($request->all());

            // $studentcourse->update($request->all());
            return redirect()->route('studentcourses.index')->with('success', 'Excercise added successfully');
        }

        // return redirect()->route('studentcourses.index')->with('success','Excercise added successfully');


    }

    public function destroy()
    {
    }
}
