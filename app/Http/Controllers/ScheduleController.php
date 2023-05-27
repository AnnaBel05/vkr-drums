<?php

namespace App\Http\Controllers;

use App\Models\DayOfWeek;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\StudentCourse;
use App\Models\User;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $professors = User::where('role_id', 2)->get();
        $students = User::where('role_id', 3)->get();
        $headers = ['Content-Type' => 'application/json; charset=utf-8'];
        $schedules = Schedule::all();

        $professorFilter = $request->input('professor_filter');
        $studentFilter = $request->input('student_filter');
        $dateFilter = $request->input('date_filter');

        $schedules = Schedule::query();

        if ($professorFilter) {
            $schedules->where('professor_id', $professorFilter);
        }

        if ($studentFilter) {
            $schedules->where('student_id', $studentFilter);
        }

        $schedules = $schedules->get();

        return view('schedules.index', compact('schedules', 'professors', 'students'));
    }

    public function create()
    {
        $professors = User::where('role_id', 2)->get();
        $students = User::where('role_id', 3)->get();
        $dayOfWeek = DayOfWeek::all();
        $room = Room::all();

        return view('schedules.create', compact('professors', 'students', 'dayOfWeek', 'room'));
    }

    public function store(Request $request)
    {
        // dd($request);
        Schedule::create($request->all());

        return redirect()->route('schedules.index')->with('success', 'Timetable added succesfully.');
    }

    public function show(Schedule $schedule)
    {
        return view('schedules.show', compact('schedule'));
    }

    public function edit(Schedule $schedule)
    {
        $professor = User::all();
        $studentCourse = StudentCourse::all();
        $dayOfWeek = DayOfWeek::all();
        $room = Room::all();

        return view('schedules.edit', compact('schedule', 'professor', 'studentCourse', 'dayOfWeek', 'room'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $schedule->professor_id = $request->professor_id;
        $schedule->day_of_week_id = $request->dayOfWeek_id;
        $schedule->room_id = $request->room_id;

        $schedule->update($request->all());

        return redirect()->route('schedules.index')->with('success', 'Timetable updated successfully');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('schedules.index')->with('success', 'Timetable entry deleted successfully');
    }

    public function signup()
    {
    }
}
