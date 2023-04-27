<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TestTable;

class HomeController extends Controller
{
    public function index() 
    {
        $headers = [ 'Content-Type' => 'application/json; charset=utf-8' ];
        $testtables = TestTable::with(array('roles'))->get();

        return view('view-roles', compact('testtables'));
    }
}
