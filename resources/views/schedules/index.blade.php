@extends('welcome')
@section('title', 'Расписание')
@section('content')

    @php
        $weekday = null;
        $daycount = 0;
        $roomcount = 0;
    @endphp

    <div class="container3 divdesignwhite">
        <div>
            <div class="row">
                <h1 class="h2style"> Расписание </h1>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div>
            <form action="{{ route('schedules.index') }}" method="GET">
                <div>
                    <div class="form-group">
                        <strong>Выберите преподавателя:</strong>
                        <input type="text" id="professor_input" list="professor_list">
                        <input type="hidden" id="professor_id" name="professor_id">
                        <datalist id="professor_list">
                            @foreach ($professors as $professorValue)
                                <option value="{{ $professorValue->last_name }}"
                                    data-professor-id="{{ $professorValue->id }}">
                                    {{ $professorValue->full_name }} {{ $professorValue->patronymic }}
                                </option>
                            @endforeach
                        </datalist>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <strong>Выберите студента: </strong>
                            <input type="text" id="student_input" list="student_list">
                            <input type="hidden" id="student_id" name="student_id">
                            <datalist id="student_list">
                                @foreach ($students as $student)
                                    <option value="{{ $student->last_name }}" data-student-id="{{ $student->id }}">
                                        {{ $student->full_name }} {{ $student->patronymic }}
                                    </option>
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary bttnbold bttnunderline">Применить фильтры</button>
            </form>
        </div>

        <div>
            <div class="pull-right">
                <a class="btn btn-success bttnbold bttnunderline" href="{{ route('schedules.create') }}"> Обновить
                    расписание </a>
            </div>
        </div>

        @if ($professor != null)
            <br>
            <p> Фильтрация по преподавателю: {{ $professor->last_name }} {{ mb_substr($professor->full_name, 0, 1) }}.
                {{ mb_substr($professor->patronymic, 0, 1) }}.</p>
        @endif

        @if ($studentt != null)
            <p> Фильтрация по студенту: {{ $studentt->last_name }} {{ mb_substr($studentt->full_name, 0, 1) }}.
                {{ mb_substr($studentt->patronymic, 0, 1) }}.</p>
        @endif

        <div>
            <br>
            <table>
                <thead>
                    <tr>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($days as $day)
                        @php
                            $daycount = 0;
                        @endphp
                        <tr>
                            <td colspan="6" class="tdcenter"> <b> {{ $day->name }} </b></td>
                        </tr>
                        <tr>
                            @foreach ($rooms as $room)
                                <td>{{ $room->begin_time }} - {{ $room->end_time }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            @foreach ($schedules->sortBy('day_of_week_id') as $schedule => $scheduleValue)
                                @while ($daycount < 6)
                                    @foreach ($rooms as $room)
                                        @if ($scheduleValue->rooms->id == $room->id && $scheduleValue->daysofweek == $day)
                                            <td>
                                                {{-- {{ $scheduleValue->rooms->id }} --}}
                                                {{-- {{ $rooms->id}} --}}
                                                {{ trim($scheduleValue->professors->last_name) }}
                                                {{ mb_substr($scheduleValue->professors->full_name, 0, 1) }}.
                                                {{ mb_substr($scheduleValue->professors->patronymic, 0, 1) }}.
                                                -
                                                {{ trim($scheduleValue->students->last_name) }}
                                                {{ mb_substr($scheduleValue->students->full_name, 0, 1) }}.
                                                {{ mb_substr($scheduleValue->students->patronymic, 0, 1) }}.
                                            </td>
                                        @else
                                            <td>
                                                {{-- {{ $daycount }} --}}
                                                {{-- <a class="btn btn-success bttnunderline" href="{{ route('schedules.create') }}"> Записаться </a> --}}
                                            </td>
                                        @endif
                                        @php
                                            $daycount += 1;
                                        @endphp
                                    @endforeach
                                @endwhile
                            @endforeach
                            @php
                                $daycount = 0;
                            @endphp
                        </tr>
                        <tr>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        <div>
            <div class="row">
                @foreach ($schedules->sortBy('day_of_week_id') as $schedule => $scheduleValue)
                    <div>
                        <div>
                            <ul class="text-align:center display:inline-block">
                                <div>
                                    <div>
                                        @if ($scheduleValue->daysofweek->name != $weekday)
                                            <h2 class="h2style">{{ $scheduleValue->daysofweek->name }}</h2>
                                            @php
                                                $weekday = $scheduleValue->daysofweek->name;
                                            @endphp
                                        @endif
                                    </div>
                                    <div class="imginline">
                                        <li class="inline">
                                            {{ $scheduleValue->rooms->begin_time ?? '??' }} :
                                        </li>
                                        <li class="inline">
                                            {{ $scheduleValue->rooms->end_time ?? '??' }}
                                        </li>
                                        <div>
                                            <li class="inline">
                                                {{ $scheduleValue->professors->last_name }}
                                                {{ $scheduleValue->professors->full_name }}
                                                {{ $scheduleValue->professors->patronymic }} -
                                            </li>
                                            <li class="inline">
                                                {{ $scheduleValue->students->last_name }}
                                                {{ $scheduleValue->students->full_name }}
                                                {{ $scheduleValue->students->patronymic }}
                                            </li>
                                        </div>

                                        <div class="imginline">
                                            <li class="inline">
                                                <a class="bttn"
                                                    href="{{ route('schedules.show', $scheduleValue->id) }}">Show</a>
                                            </li>
                                            <li class="inline">
                                                <a class="bttn2"
                                                    href="{{ route('schedules.edit', $scheduleValue->id) }}">Edit</a>
                                            </li>
                                            <li class="inline">
                                                <form style="display: inline-block;"
                                                    action="{{ route('schedules.destroy', $scheduleValue->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </li>
                                        </div>

                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        var professorInput = document.getElementById('professor_input');
        var professorIdInput = document.getElementById('professor_id');

        professorInput.addEventListener('input', function() {
            var selectedOption = getSelectedOptionByValue(this.value, 'professor_list');
            if (selectedOption) {
                professorIdInput.value = selectedOption.dataset.professorId;
            } else {
                professorIdInput.value = '';
            }
        });

        var studentInput = document.getElementById('student_input');
        var studentIdInput = document.getElementById('student_id');

        studentInput.addEventListener('input', function() {
            var selectedOption = getSelectedOptionByValue(this.value, 'student_list');
            if (selectedOption) {
                studentIdInput.value = selectedOption.dataset.studentId;
            } else {
                studentIdInput.value = '';
            }
        });

        function getSelectedOptionByValue(value, dataListId) {
            var dataList = document.getElementById(dataListId);
            var options = dataList.getElementsByTagName('option');
            for (var i = 0; i < options.length; i++) {
                if (options[i].value === value) {
                    return options[i];
                }
            }
            return null;
        }
    </script>

@endsection
