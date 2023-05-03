@extends('welcome')
@section('title', 'Курс')
@section('content')

<div>
    <div class="container">
        <div class="row">
            <h3> Course </h3>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div>
        <ul class="text-align:center display:inline-block">
            <li>
               Преподаватель: {{ $studentcourse->professor->name }} 
            </li>
            <li>
               Студент: {{ $studentcourse->student->name }} 
            </li>
        </ul>
    </div>
</div>     

@endsection
