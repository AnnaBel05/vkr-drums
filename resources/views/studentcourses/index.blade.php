@extends('welcome')
@section('title', 'Курс')
@section('content')

    @php
        $prevAssignment = null;
    @endphp

    <div class="divdesignwhite container3 content">
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
                        <a class="btn btn-success bttnbold" href="{{ route('studentcourses.create') }}"> > Создать новый курс </a>
                    </div>

                    <div class="pull-right">
                        <a class="btn btn-success bttnbold" href="{{ route('studentcourses.edit', $studentcourse->id) }}"> > Добавить задание
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
                        Преподаватель: {{ trim($professor->last_name) }} {{ mb_substr($professor->full_name, 0, 1) }}. {{ mb_substr($professor->patronymic, 0, 1) }}.
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
                                            <a class="bttnunderline" href="{{ route('studentcourses.show', $sc->id) }}">{{ $sc->name }},</a>
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
        <button class="toggle-btn" data-section="section2"> 
            <h1 class="h2style"> >Теория </h1>    
        </button>

        <div class="container2 section" id="section2">
            <div>
                <div class="row">
                    <h1 class="h1style"> Теория </h1>
                </div>
            </div>
            @foreach ($excercises as $excercise)
                <ul>
                    {{-- <li class="inline">
                        {{ $excercise->task_name ?? '' }}
                    </li> --}}
                    <li class="inline">
                        <a class="bttnunderline" href="{{ url('/storage/' . $excercise->medias->link) }}"> {{ $excercise->task_name ?? '' }}</a>
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
                    @if (Auth::user()->role_id == 3)
                        <li class="inline">
                            | <a class="bttnunderline" href="{{ route('studentcourses.edit-task', $excercise->id) }}">Добавить
                                ответ</a>
                        </li>
                    @endif
                    <li>
                        {{ $excercise->theory ?? '' }}
                    </li>
                    <li class="inline">
                        @if (pathinfo($excercise->medias->link, PATHINFO_EXTENSION) == 'png' ||
                                pathinfo($excercise->medias->link, PATHINFO_EXTENSION) == 'jpg')
                            <img src="{{ url('/storage/' . $excercise->medias->link) }}" width="100">
                        @endif
                    <li>
                        <div>
                            <br>
                        </div>
                    </li>
                    </li>
                </ul>
            @endforeach
        </div>

        <br>
        <button class="toggle-btn" data-section="section3"> 
            <h1 class="h2style"> > Задания </h1>    
        </button>

        <div class="container section" id="section3">
            <div>
                <div class="row">
                    <h1 class="h1style"> Задания </h1>
                </div>
            </div>
            <div class="pull-right">
                <a class="btn btn-success bttnbold" href="{{ route('studentcourses.show-task-results') }}"> Просмотреть отчет по
                    оценкам
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
                            @if (Auth::user()->role_id == 2)
                            <li class="inline">
                                {{ trim($result->students->last_name) }}
                            </li>
                            <li class="inline">
                                {{ mb_substr($result->students->full_name, 0, 1) }}.
                            </li>
                            <li class="inline">
                                {{ mb_substr($result->students->patronymic, 0, 1) }}.
                            </li>
                            @endif
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
                                        <a class="bttnunderline"
                                            href="{{ url('/storage/' . $result->medias?->link) }}">Скачать</a>
                                    </li>
                                @endif

                                @if (Auth::user()->role_id == 2)
                                    <li class="inline">
                                        
                                        <a class="bttnunderline"
                                            href="{{ route('studentcourses.mark-task', $result->id) }}">Оценить</a>
                                    </li>
                                @endif
                            </div>
                        </div>
                    @endforeach
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
