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
        // $testtables = TestTable::with(array('roles'))->get();
        $testtables = TestTable::all();


        return view('view-roles', compact('testtables'));
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
