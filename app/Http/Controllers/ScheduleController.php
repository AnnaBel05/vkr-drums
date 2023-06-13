<?php

namespace App\Http\Controllers;

use App\Models\DayOfWeek;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\StudentCourse;
use App\Models\User;
use Carbon\Carbon;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nette\Utils\DateTime;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $professors = User::where('role_id', 2)->get();
        $students = User::where('role_id', 3)->get();
        $headers = ['Content-Type' => 'application/json; charset=utf-8'];

        $timestamp = Carbon::now()->timestamp; 

        $date = DateTime::createFromFormat('U', $timestamp);
        $date->setTime(0, 0, 0); 
        $dayOfWeek = $date->format('N'); 
        $startDate = clone $date;
        $endDate = clone $date;

        $startDate->modify('-' . ($dayOfWeek - 1) . ' day');
        $endDate->modify('+' . (7 - $dayOfWeek) . ' day');

        // dd($endDate);

        $schedule = Schedule::where('id',8)->get();


        $schedules = Schedule::where('date', '>=', $startDate)->where('date', '<=', $endDate)->get();
        // dd($schedules);


        $professorFilter = $request->input('professor_id');
        $studentFilter = $request->input('student_id');
;

        $professor = null;
        $studentt = null;

        if ($professorFilter) {
            $schedules->where('professor_id', $professorFilter);
            $professor = User::where('id', $professorFilter)->first();
            // dd($professor);
            // dd($request);
        }

        if ($studentFilter) {
            $schedules->where('student_id', $studentFilter);
            $studentt = User::where('id', $studentFilter)->first();
        }

        $rooms = Room::all();
        $days = DayOfWeek::all();
        // $schedules = $schedules->get();

        return view('schedules.index', compact('schedules', 'professors', 'students', 'rooms', 'days', 'professor', 'studentt'));
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
