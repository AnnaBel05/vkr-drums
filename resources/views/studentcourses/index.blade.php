@extends('welcome')
@section('title', 'Курс')
@section('content')

    <div>
        <div class="container">
            <div class="row">
                <h3> Course </h3>
            </div>
        </div>

        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('studentcourses.create') }}"> Create New Course </a>
        </div>

        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('studentcourses.edit', $studentcourse->id) }}"> Add a task </a>
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
                <li>
                    Список заданий:
                </li>
            </ul>
            @foreach ($excercises as $excercise)
                <ul>
                    <li class="inline">
                        {{ $excercise->theory ?? '' }}
                    </li>
                    <li class="inline">
                        <img src="{{ url('/storage/' . $excercise->medias->link) }}" width="200px">
                    </li>
                </ul>
            @endforeach
        </div>

        <div>
            @yield('second_content')
        </div>
    </div>

@endsection
