@extends('welcome')
@section('title', 'Курс')
@section('content')

    @php
        $prevStudent = null;
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
                                <li>{{ $result->students->name }}:</li>
                                @php
                                    $prevStudent = $result->students->name;
                                @endphp
                            @endif
                            <li class="inline">
                                {{ $result->excercise->task_name }}:
                            </li>
                            <li class="inline">
                                {{ $result->mark ?? 'Не оценено' }}
                            </li>
                            <br>
                @endforeach
            </ul>
        </div>
    </div>


@endsection
