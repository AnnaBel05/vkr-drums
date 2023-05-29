@extends('welcome')
@section('title', 'Курс')
@section('content')

    @php
        $prevAssignment = null;
    @endphp

    <div class="container3">
        <div>
            <div class="row">
                <h3> Курс </h3>
            </div>
        </div>

        @auth
            @if (auth()->user()->role_id == 2)
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('studentcourses.create') }}"> Create New Course </a>
                </div>

                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('studentcourses.edit', $studentcourse->id) }}"> Add a task </a>
                </div>
            @endif
        @endauth

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div>
            <ul class="text-align:center display:inline-block">
                <li>
                    Преподаватель: {{ trim($professor->name) }}
                </li>
                <li>
                    Студент:
                    <ul>
                        @foreach ($students as $student)
                            <li class="inline"> {{ trim($student->name) }};</li>
                        @endforeach
                    </ul>
                </li>
                <div>
                    @foreach ($studentcourses as $sc)
                        <ul>
                            <li class="inline">
                                {{ $sc->name }}
                            </li>
                            <li class="inline">
                                <a class="bttn2" href="{{ route('studentcourses.show', $sc->id) }}">Просмотреть курс</a>
                            </li>
                        </ul>
                    @endforeach
                </div>

                {{-- <li>
                    example text example text example text example text example text example text example text 
                </li> --}}
            </ul>
        </div>


        <div>
            @yield('second_content')
        </div>
    </div>

    <div class="container2">
        <div>
            <div class="row">
                <h3> Теория </h3>
            </div>
        </div>
        @foreach ($excercises as $excercise)
            <ul>
                <li class="inline">
                    {{ $excercise->task_name ?? '' }}
                </li>
                <li class="inline">
                    |
                    <a class="bttn2" href="{{ url('/storage/' . $excercise->medias->link) }}">Скачать</a> |
                </li>
                {{-- @if ($excercise->result_type_id == 1)
                    @if (Auth::user()->role_id == 3)
                    |
                        <li class="inline">
                            <a class="bttn" href="{{ route('studentcourses.edit-task', $excercise->id) }}">Добавить
                                ответ</a>
                        </li>
                    @endif
                @else
                    <li class="inline">
                        <a class="bttn ahidden" href="{{ route('studentcourses.edit-task', $excercise->id) }}">Добавить
                            ответ</a>
                    </li>
                @endif --}}
                <li class="inline">
                    <a class="bttn" href="{{ route('studentcourses.edit-task', $excercise->id) }}">Добавить
                        ответ</a>
                </li>
                <li>
                    {{ $excercise->theory ?? '' }}
                </li>
                <li class="inline">
                    @if (pathinfo($excercise->medias->link, PATHINFO_EXTENSION) == 'png' ||
                            pathinfo($excercise->medias->link, PATHINFO_EXTENSION) == 'jpg')
                        <img src="{{ url('/storage/' . $excercise->medias->link) }}" width="100">
                    @endif
                <li>
                </li>
                </li>
            </ul>
        @endforeach
    </div>

    <div class="container2">
        <div>
            <div class="row">
                <h3> Задания </h3>
            </div>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('studentcourses.show-task-results') }}"> Просмотреть отчет по оценкам
            </a>
        </div>
        <div>
            <ul>
                @foreach ($results->sortBy('excercise_id') as $result)
                    @if ($result->excercise->task_name != $prevAssignment)
                        <h2 class="h2style">{{ $result->excercise->task_name }}</h2>
                        @php
                            $prevAssignment = $result->excercise->task_name;
                        @endphp
                    @endif
                    <div class="divborder">
                        <li class="inline">
                            {{ $result->students->name }}
                        </li>
                        <li>
                            Оценка: {{ $result->mark ?? 'Не оценено' }}
                        </li>
                        <li class="inline">
                            @if ($result->medias?->link != null)
                                @if (pathinfo($result->medias->link, PATHINFO_EXTENSION) == 'png' ||
                                        pathinfo($result->medias->link, PATHINFO_EXTENSION) == 'jpg')
                                    <img src="{{ url('/storage/' . $result->medias->link) }}" width="100">
                                @endif
                            @endif
                        </li>
                        <div>
                            @if ($result->medias?->link == null)
                                <li class="inline">
                                </li>
                            @elseif ($result->medias?->link != null)
                                <li class="inline">
                                    <a class="bttn2" href="{{ url('/storage/' . $result->medias?->link) }}">Скачать</a>
                                </li>
                            @endif

                            @if (Auth::user()->role_id == 2)
                                <li class="inline">
                                    <a class="bttn"
                                        href="{{ route('studentcourses.mark-task', $result->id) }}">Оценить</a>
                                </li>
                            @endif
                        </div>
                    </div>
                @endforeach
            </ul>
        </div>
    </div>


@endsection