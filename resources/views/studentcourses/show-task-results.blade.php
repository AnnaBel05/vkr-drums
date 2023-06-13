@extends('welcome')
@section('title', 'Курс')
@section('content')

    @php
        $prevStudent = null;
        $sum = null;
        $prevRes = null;
    @endphp

    <div class="container3 divdesignwhite content">
        <button class="toggle-btn" data-section="section1">
            <h1 class="h2style"> > Курс </h1>
        </button>
        <div class="container2 section" id="section1">
            <div>
                <div class="row">
                    {{-- <h1 class="h1style"> Курс </h1> --}}
                </div>
            </div>

            @auth
                @if (auth()->user()->role_id == 2)
                    <div class="pull-right">
                        <a class="btn btn-success bttnbold" href="{{ route('studentcourses.create') }}"> > Создать новый курс
                        </a>
                    </div>

                    <div class="pull-right">
                        <a class="btn btn-success bttnbold" href="{{ route('studentcourses.edit', $studentcourse->id) }}"> >
                            Добавить задание
                        </a>
                    </div>
                @endif
            @endauth

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <br>
            <div>
                <ul class="text-align:center display:inline-block">
                    <li>
                        Преподаватель: {{ trim($professor->last_name) }} {{ mb_substr($professor->full_name, 0, 1) }}.
                        {{ mb_substr($professor->patronymic, 0, 1) }}.
                    </li>
                    <li>
                        <ul>
                            <li class="inline">
                                Студенты:
                            </li>
                            @foreach ($students as $student)
                                <li class="inline">
                                    {{ trim($student->last_name) }}
                                </li>
                                <li class="inline">
                                    {{ mb_substr($student->full_name, 0, 1) }}.
                                </li>
                                <li class="inline">
                                    {{ mb_substr($student->patronymic, 0, 1) }}.,
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <br>
                    @auth
                        @if (auth()->user()->role_id == 2)
                            <div>
                                <ul>
                                    <li class="inline">
                                        Ваши курсы:
                                    </li>
                                    @foreach ($studentcourses as $sc)
                                        <li class="inline">
                                            <a class="bttnunderline"
                                                href="{{ route('studentcourses.show', $sc->id) }}">{{ $sc->name }},</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    @endauth

                    {{-- <li>
                    example text example text example text example text example text example text example text 
                </li> --}}
                </ul>
            </div>


            <div>
                @yield('second_content')
            </div>
        </div>

        <br>

        {{-- TODO --}}

        <button class="toggle-btn" data-section="section2">
            <h1 class="h2style"> > Отчет по оценкам </h1>
        </button>



        <div class="container2 section" id="section3">
            <br>
            <div>
                {{-- <div class="row">
                    <h1 class="h1style"> Сводный отчет </h1>
                </div> --}}
            </div>
            <div>
                <div>
                    <br>
                    <table>
                        <thead>
                            <tr>
                                <th> </th>
                                @foreach ($results->sortBy(function ($result) {
                                    return $result->excercise->id;
                                }) as $result)
                                @if ($result->excercise->task_name != $prevRes)
                                <th> {{ $result->excercise->task_name }} </th>
                                @endif
                                @php
                                    $prevRes = $result->excercise->task_name;
                                @endphp
                                {{-- <th id="10">Задание 2</th>
                                <th id="11">Задание 3</th>
                                <th id="13">Задание 4</th> --}}
                                
                                @endforeach
                                <th>Итоговый балл</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results->sortBy(function ($result) {
            return $result->student_id . '_' . $result->excercise->task_name;
        }) as $result)
                                @if ($result->students->id == 2)
                                    <tr>
                                        @php
                                            $sum += $result->mark ?? 0;
                                        @endphp
                                        <td><b> {{ trim($result->students->last_name) }}
                                                {{ mb_substr($result->students->full_name, 0, 1) }}.
                                                {{ mb_substr($result->students->patronymic, 0, 1) }}. </b></td>
                                        <td>{{ $result->mark ?? '-' }}</td>
                                        <td>{{ $result->mark ?? '-' }}</td>
                                        <td>{{ $result->mark ?? '-' }}</td>
                                        <td>{{ $result->mark ?? '-' }}</td>
                                        <td>{{ $sum ?? 0 }}</td>
                                        @php
                                            $prevStudent = $result->students->name;
                                            $sum = 0;
                                        @endphp
                                    </tr>
                                @endif
                                @if ($result->students->name != $prevStudent && $result->students->id != 2)
                                    {{-- @if ($prevStudent != null) --}}
                                    <tr>
                                        <td><b> {{ trim($result->students->last_name) }}
                                                {{ mb_substr($result->students->full_name, 0, 1) }}.
                                                {{ mb_substr($result->students->patronymic, 0, 1) }}. </b></td>
                                        <td>{{ $result->mark ?? '-' }}</td>
                                        <td>{{ $result->mark ?? '-' }}</td>
                                        <td>{{ $result->mark ?? '-' }}</td>
                                        <td>{{ $result->mark ?? '-' }}</td>
                                        @if ($prevStudent != null)
                                            <td>{{ $sum ?? 0 }}</td>
                                        @endif
                                    </tr>
                                    {{-- <tr><td colspan="6"></td></tr> --}}
                                    {{-- @endif --}}
                                    @php
                                        $prevStudent = $result->students->name;
                                        $sum = 0;
                                    @endphp
                                @endif
                                @php
                                    $sum += $result->mark ?? 0;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <ul>
                    @foreach ($results->sortBy(function ($result) {
            return $result->student_id . '_' . $result->excercise->task_name;
        }) as $result)
                        <div>
                            @if ($result->students->name != $prevStudent)
                                @if ($prevStudent != null)
                                    <li class="">
                                        <b>Итоговый балл:</b> {{ $sum }}
                                    </li>
                                    <div>
                                        <br>
                                    </div>
                                @endif
                                <li class="inline">
                                    <b>Студент: </b>{{ trim($result->students->last_name) }}
                                    {{ mb_substr($result->students->full_name, 0, 1) }}.
                                    {{ mb_substr($result->students->patronymic, 0, 1) }}.
                                </li>
                                @php
                                    $prevStudent = $result->students->name;
                                    $sum = 0;
                                @endphp
                            @endif
                        </div>
                        <div>
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
                        </div>
                    @endforeach
                    {{-- <div>
                        <br>
                    </div> --}}
                    @if ($prevStudent != null)
                        <li class="inline">
                            <b>Итоговый балл:</b> {{ $sum }}
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toggleBtns = document.querySelectorAll('.toggle-btn');

            toggleBtns.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var sectionId = this.getAttribute('data-section');
                    var section = document.getElementById(sectionId);

                    if (section.classList.contains('active')) {
                        section.classList.remove('active');
                    } else {
                        section.classList.add('active');
                    }
                });
            });
        });
    </script>


@endsection
