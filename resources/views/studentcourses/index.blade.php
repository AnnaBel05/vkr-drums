@extends('welcome')
@section('title', 'Курс')
@section('content')

    <div class="container">
        <div>
            <div class="row">
                <h3> Курс </h3>
            </div>
        </div>

        {{-- <div class="pull-right">
            <a class="btn btn-success" href="{{ route('studentcourses.create') }}"> Create New Course </a>
        </div> --}}

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
                    Преподаватель: {{ $professor->name }}
                </li>
                <li>
                    Студент: 
                    @foreach ($students as $student)
                    <ul>
                        <li> {{ $student->name }} </li>
                    </ul>
                    @endforeach
                </li>
                {{-- <li>
                    example text example text example text example text example text example text example text 
                </li> --}}
            </ul>
        </div>


        <div>
            @yield('second_content')
        </div>
    </div>

    <div class="container">
        <div>
            <div class="row">
                <h3> Теория </h3>
            </div>
        </div>
        @foreach ($excercises as $excercise)
            <ul>
                <li class="inline">
                    {{ $excercise->theory ?? '' }}
                </li>
                <li class="inline">
                    @if (pathinfo($excercise->medias->link, PATHINFO_EXTENSION) == 'png')
                        <img src="{{ url('/storage/' . $excercise->medias->link) }}" width="100">
                    @endif
                    <li>
                        <a href="{{ url('/storage/' . $excercise->medias->link) }}">Download file</a>
                    </li>
                </li>
            </ul>
        @endforeach
    </div>

    <div class="container">

        <div>
            <div class="row">
                <h3> Список заданий </h3>
            </div>
        </div>
        @foreach ($excercises as $excercise)
            <ul>
                <li class="inline">
                    {{ $excercise->theory ?? '' }}
                </li>
                <li class="inline">
                    @if (pathinfo($excercise->medias->link, PATHINFO_EXTENSION) == 'png')
                        <img src="{{ url('/storage/' . $excercise->medias->link) }}" width="100">
                    @endif
                    <li>
                        <a href="{{ url('/storage/' . $excercise->medias->link) }}">Download file</a>
                    </li>
                </li>
            </ul>
        @endforeach
    </div>


@endsection
