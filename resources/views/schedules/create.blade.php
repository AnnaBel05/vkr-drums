@extends('welcome')
@section('title', 'Расписание')
@section('content')
    <div class="container3 divdesignwhite">
        <div class="container">
            <div class="row">
                <h1 class="h2style"> Расписание </h1> 
            </div>
        </div>


        <div>
            <form action="{{ route('schedules.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="form-group">
                        <strong>Преподаватель:</strong>
                        <input type="text" id="professor_input" list="professor_list" required>
                        <input type="hidden" id="professor_id" name="professor_id" required>
                        <datalist id="professor_list">
                            @foreach ($professors as $professorValue)
                                <option value="{{ $professorValue->last_name }}" data-professor-id="{{ $professorValue->id }}">
                                    {{ $professorValue->full_name }} {{ $professorValue->patronymic }}
                                </option>
                            @endforeach
                        </datalist>
                    </div>
                </div>


                <div class="row">
                    <div class="form-group">
                        <br>
                        <strong>Студент: </strong>
                        <input type="text" id="student_input" list="student_list" required>
                        <input type="hidden" id="student_id" name="student_id" required>
                        <datalist id="student_list">
                            @foreach ($students as $student)
                                <option value="{{ $student->last_name }}" data-student-id="{{ $student->id }}">
                                    {{ $student->full_name }} {{ $student->patronymic }}
                                </option>
                            @endforeach
                        </datalist>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <br>
                        <strong>День недели: </strong>
                        <input type="text" id="dayofweek_input" list="dayofweek_list" required>
                        <input type="hidden" id="day_of_week_id" name="day_of_week_id" required>
                        <datalist id="dayofweek_list">
                            @foreach ($dayOfWeek as $value)
                                <option value="{{ $value->name }}" data-dayofweek-id="{{ $value->id }}"></option>
                            @endforeach
                        </datalist>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <br>
                        <strong>Время: </strong>
                        <input type="text" id="room_input" list="room_list" required>
                        <input type="hidden" id="room_id" name="room_id" required>
                        <datalist id="room_list">
                            @foreach ($room as $value)
                                <option value="{{ $value->begin_time }} : {{ $value->end_time }}"
                                    data-room-id="{{ $value->id }}"></option>
                            @endforeach
                        </datalist>
                    </div>
                </div>


                <div class="row">
                    <br>
                    <label for="date"> <b>Дата:</b></label>
                    <input type="datetime-local" name="date" id="date">
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary bttnbold">Подтвердить</button>
                </div>
            </form>
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

        var dayOfWeekInput = document.getElementById('dayofweek_input');
        var dayOfWeekIdInput = document.getElementById('day_of_week_id');

        dayOfWeekInput.addEventListener('input', function() {
            var selectedOption = getSelectedOptionByValue(this.value, 'dayofweek_list');
            if (selectedOption) {
                dayOfWeekIdInput.value = selectedOption.dataset.dayofweekId;
            } else {
                dayOfWeekIdInput.value = '';
            }
        });

        var roomInput = document.getElementById('room_input');
        var roomIdInput = document.getElementById('room_id');

        roomInput.addEventListener('input', function() {
            var selectedOption = getSelectedOptionByValue(this.value, 'room_list');
            if (selectedOption) {
                roomIdInput.value = selectedOption.dataset.roomId;
            } else {
                roomIdInput.value = '';
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
