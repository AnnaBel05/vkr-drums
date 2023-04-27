<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function index() {
        $headers = [ 'Content-Type' => 'application/json; charset=utf-8' ];
        $schedules = DB::table('schedules')->get();

        return view('schedule',compact('schedules'));
    }

    public function signup() {

    }
}
