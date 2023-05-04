<?php

namespace App\Http\Controllers;

use App\Models\Excercise;
use App\Models\Media;
use App\Models\StudentCourse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentCourseController extends ExcerciseController
{
    public function index() {
        $headers = [ 'Content-Type' => 'application/json; charset=utf-8' ];
        $studentcourses = StudentCourse::all();

        $studentid = Auth::id();

        $studentcourse = StudentCourse::where('student_id',$studentid)->first();
        $excercises = Excercise::where('student_course_id',$studentcourse->id)->get();

        if ($studentcourse != null) {
            return view('studentcourses.index',compact('studentcourse','excercises'));
        }
        else {
            return view('studentcourses.indexnew');
        }
    }

    public function upload(Request $request) 
    {
        
    }

    // TODO: create for professors only
    // TODO: sign up with diff roles (not in this class)

    public function create() 
    {
        $professor = User::all();
        $student = User::all();
        return view('studentcourses.create', compact('professor','student'));
    }

    public function store(Request $request) 
    {
        $studentCourse = StudentCourse::create($request->all());

        $studentCourse->professor_id = $request->professor_id;
        $studentCourse->student_id = $request->student_id;
        
        $studentCourse->update($request->all());

        return redirect()->route('studentcourses.index')->with('success','Course was created succesfully.');
    }

    public function show() 
    {

    }

    public function edit(StudentCourse $studentcourse) 
    {
        $media = Media::all();
        $excercise = Excercise::all();


        return view('studentcourses.edit', compact('studentcourse','media','excercise'));
    }

    public function update(Request $request, StudentCourse $studentcourse) 
    {
        $input = $request->all();

        $studentcourse->updated_at = now();

        if($request->hasFile('media'))
        {
            $destination_path = 'public/media/course';
            $media = $request->file('media');
            $mediaName = $media->getClientOriginalName();
            $path = $request->file('media')->storeAs($destination_path,$mediaName);

            $mediaVal = new Media;
            $mediaVal->name = $mediaName;
            $mediaVal->link = $path;
            $mediaVal->save($request->all());

            $excercise = new Excercise;
            $excercise->media_id = $mediaVal->id;
            $excercise->theory = $request->theory;
            $excercise->student_course_id = $studentcourse->id;
            $excercise->save($request->all());

            $studentcourse->update($request->all());
            return redirect()->route('studentcourses.index')->with('success','Excercise added successfully');
        }
        else {
            $excercise = new Excercise;
            $excercise->media_id = null;
            $excercise->theory = $request->theory;
            $excercise->student_course_id = $studentcourse->id;
            $excercise->save($request->all());

            $studentcourse->update($request->all());
            return redirect()->route('studentcourses.index')->with('success','Excercise added successfully');
        }

        // return redirect()->route('studentcourses.index')->with('success','Excercise added successfully');

        
    }

    public function destroy() 
    {

    }
}
