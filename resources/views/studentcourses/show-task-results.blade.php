@extends('welcome')
@section('title', 'Курс')
@section('content')

    @php
        $prevStudent = null;
        $sum = null;
    @endphp

    <div class="container3">
        <div>
            <div class="row">
                <h3> Курс </h3>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

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
                {{-- <li>
                    example text example text example text example text example text example text example text 
                </li> --}}
            </ul>
        </div>

        @auth
            @if (auth()->user()->role_id == 2)
                <div>
                    @foreach ($studentcourses as $sc)
                        <ul>
                            <li class="inline">
                                {{ $sc->name }}
                            </li>
                            <li class="inline">
                                <a class="bttn2" href="{{ route('studentcourses.show', $sc->id) }}">Просмотреть
                                    курс</a>
                            </li>
                        </ul>
                    @endforeach
                </div>
            @endif
        @endauth

    </div>

    <div class="container2">
        <div>
            <div class="row">
                <h3> Сводный отчет </h3>
            </div>
        </div>
        <div>
            <ul>
                @foreach ($results->sortBy(function ($result) {
            return $result->student_id . '_' . $result->excercise->task_name;
        }) as $result)
                    @if ($result->students->name != $prevStudent)
                        @if ($prevStudent != null)
                            <li class="inline">
                                <b>Итоговый балл:</b> {{ $sum }}
                            </li>
                        @endif
                        <li>{{ $result->students->name }}:</li>
                        @php
                            $prevStudent = $result->students->name;
                            $sum = 0;
                        @endphp
                    @endif
                    <li class="inline">
                        {{ $result->excercise->task_name }}:
                    </li>
                    <li class="inline">
                        {{ $result->mark ?? 'Не оценено' }}
                    </li>
                    @php
                        $sum += $result->mark ?? 0;
                    @endphp
                    <br>
                @endforeach
                @if ($prevStudent != null)
                    <li class="inline">
                        <b>Итоговый балл:</b> {{ $sum }}
                    </li>
                @endif

            </ul>
        </div>
    </div>


@endsection
