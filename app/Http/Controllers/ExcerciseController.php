<?php

namespace App\Http\Controllers;

use App\Models\Excercise;
use App\Models\Media;
use Illuminate\Http\Request;

class ExcerciseController extends Controller
{
    public function index() {
        return view('excercises.index');
    }

    public function createExcercise() 
    {
        
    }

    public function storeExcercise(Request $request) 
    {
        $input = $request->all();
        if($request->hasFile('media'))
        {
            $destination_path = 'public/media/course';
            $media = $request->file('media');
            $mediaName = $media->getClientOriginalName();
            $path = $request->file('media')->storeAs($destination_path,$mediaName);

            $input['name'] = $mediaName; 
        }

        $media = Media::create($input);
        $excercise = Excercise::create($request->all());

        return redirect()->route('excercises.index')->with('success','Task was added succesfully.');
    }
}
