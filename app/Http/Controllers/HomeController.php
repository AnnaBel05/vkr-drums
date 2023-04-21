<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() 
    {
        $headers = [ 'Content-Type' => 'application/json; charset=utf-8' ];
        $roles = DB::table('roles')->get();

        return view('view-roles', compact('roles'));
    }
}
