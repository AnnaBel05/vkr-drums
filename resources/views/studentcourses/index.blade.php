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
                        <img src="{{ $excercise->medias->link ?? '??' }}" >
                    </li>
                </ul>
            @endforeach
        </div>
        <img src="/storage/app/public/media/course/Screenshot from 2022-12-24 23-33-35.png">

        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('studentcourses.edit', $studentcourse->id) }}"> Add a task </a>
        </div>

        <div>
            @yield('second_content')
        </div>
    </div>

@endsection
