<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function index() 
    {
        $headers = [ 'Content-Type' => 'application/json; charset=utf-8' ];
        $schedules = Schedule::all();

        return view('schedules.index',compact('schedules'));
    }

    public function create() 
    {
        return view('schedules.create');
    }

    public function store(Request $request) 
    {
        Schedule::create($request->all());

        return redirect()->route('schedules.index')->with('success','Timetable added succesfully.');
    }

    public function show(Schedule $schedule) 
    {

        return view('schedules.show',compact('schedule'));
    }

    public function edit(Schedule $schedule) 
    {
        $professor = User::all();

        return view('schedules.edit',compact('schedule','professor'));
    }

    public function update(Request $request, Schedule $schedule) 
    {
        $schedule->update($request->all());

        return redirect()->route('schedules.index')->with('success','Timetable updated successfully');
    }

    public function destroy(Schedule $schedule) 
    {
        $schedule->delete();

        return redirect()->route('schedules.index')->with('success','Timetable entry deleted successfully');
    }

    public function signup() 
    {

    }
}
