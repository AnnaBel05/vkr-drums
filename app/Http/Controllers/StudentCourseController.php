<?php

namespace App\Http\Controllers;

use App\Models\Excercise;
use App\Models\Media;
use App\Models\Result;
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
                // dd($students);
                $excercises = Excercise::where('student_course_id', $studentcourse->id)->get();
                if ($user->role_id == 3) {
                    $results = Result::where('student_id', $user->id)->get();
                    // dd($results);
                    return view('studentcourses.index', compact('studentcourse', 'excercises', 'professor', 'students', 'results'));
                } else if ($user->role_id == 2) {
                    $studentcourses = $professor->courses;
                    // dd($studentcourses);
                    $results = Result::where('professor_id', $user->id)->get();
                    return view('studentcourses.index', compact('studentcourses','studentcourse', 'excercises', 'professor', 'students', 'results'));
                }
            } else {
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
        $professor = User::where('role_id', 2)->get();

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

    public function show(StudentCourse $studentcourse)
    {
        if (Auth::check()) {
            $userid = Auth::id();
            $user = User::where('id', $userid)->first();

            // dd($user->course_id);

            if ($user->course_id != null) {
                $headers = ['Content-Type' => 'application/json; charset=utf-8'];
                // $studentcourses = StudentCourse::all();
                // $studentcourse = $user->course;
                $professor = $studentcourse->professor()->first();
                $students = User::where('course_id', $studentcourse->id)
                    ->where('role_id', 3)->get();
                // dd($students);
                $excercises = Excercise::where('student_course_id', $studentcourse->id)->get();
                if ($user->role_id == 2) {
                    $studentcourses = $professor->courses;
                    $id = $studentcourse->id;
                    // dd($studentcourses);
                    // $results = Result::where('professor_id', $user->id)->get();
                    $results = Result::whereHas('excercise',function ($query) use ($id) 
                    {
                        $query->where('student_course_id', $id);
                    })->get();
                    return view('studentcourses.show', compact('studentcourses','studentcourse', 'excercises', 'professor', 'students', 'results'));
                }
            } else {
                return view('studentcourses.indexnew');
            }
        } else {
            return view('studentcourses.index-no-login');
        }
        // return view('studentcourses.show', compact('studentCourse'));   
    }

    public function showTaskResults() 
    {
        $userid = Auth::id();
        $user = User::where('id',$userid)->first();
        // dd($user);

        if ($user->role_id == 2) 
        {
            $results = Result::where('professor_id', $user->id)->get();
            $professor = $user;
            $studentcourse = $professor->course;

            $students = User::where('course_id', $studentcourse->id)
                ->where('role_id', 3)->get();

            return view('studentcourses.show-task-results', compact('results','studentcourse','professor','students'));
        }
        else if ($user->role_id == 3)
        {
            $student = $user;
            $results = Result::where('student_id', $student->id)->get();
            // dd($results);
            $studentcourse = $student->course;
            $professor = User::where('course_id', $studentcourse->id)
                ->where('role_id',2)->first();

            $students = User::where('course_id', $studentcourse->id)
                ->where('role_id', 3)->get();

            return view('studentcourses.show-task-results', compact('results','studentcourse','professor','students'));
        }
    }

    public function editTask($id)
    {
        $excercise = Excercise::find($id);
        $media = Media::all();

        return view('studentcourses.edit-task', compact('excercise', 'media'));
    }

    public function updateTask(Request $request, $id)
    {
        $result = new Result;

        $excercise = Excercise::find($id);
        $courseid = $excercise->student_course_id;
        $professor = User::where('course_id', $courseid)->where('role_id', 2)->first();

        if (Auth::check()) {
            $userid = Auth::id();
            $user = User::where('id', $userid)->first();

            if ($user->role_id == 3) 
            {
                $result->student_id = $user->id;
                $result->excercise_id = $excercise->id;

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

                    $result->media_id = $mediaVal->id;
                } else
                {
                    $result->media_id = null;
                }

                $result->professor_id = $professor->id;
                $result->created_at = now();

                $result->save($request->all());


            } else if ($user->role_id == 2) 
            {
                return view('studentcourses.edit-cant');
            }
        }

        // $excercise->save($request->all());

        return redirect()->route('studentcourses.index')->with('success', 'Ответ на задание добавлен!');
    }

    public function markTask($id)
    {
        $result = Result::where('id', $id)->first();
        // dd($result);

        return view('studentcourses.mark-task', compact('result'));
    }

    public function saveMark(Request $request, $id)
    {
        $result = Result::where('id',$id)->first();
        $result->updated_at = now();
        $result->update($request->all());

        return redirect()->route('studentcourses.index')->with('success', 'Оценка сохранена!');
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
