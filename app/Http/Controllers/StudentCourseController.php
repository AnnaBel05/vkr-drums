<?php

namespace App\Http\Controllers;

use App\Models\StudentCourse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentCourseController extends Controller
{
    public function index() {
        $headers = [ 'Content-Type' => 'application/json; charset=utf-8' ];
        $studentcourses = StudentCourse::all();

        $studentid = Auth::id();

        $studentcourse = StudentCourse::where('student_id',$studentid)->first();

        if ($studentcourse != null) {
            return view('studentcourses.index',compact('studentcourse'));
        }
        else {
            return view('studentcourses.indexnew');
        }
    }

    public function upload(Request $request) 
    {
        
    }

    public function create() 
    {

    }

    public function store() 
    {

    }

    public function show() 
    {

    }

    public function edit() 
    {

    }

    public function update() 
    {

    }

    public function destroy() 
    {

    }
}
