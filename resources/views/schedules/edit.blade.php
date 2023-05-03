@extends('welcome')
@section('title', 'Расписание')
@section('content')
    <div>
        <div class="container">
            <div class="row">
                <h3> Расписание </h3>
            </div>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('schedules.update', $schedule->id) }}" method="POST">
            @csrf
            @method('PUT')
             <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Преподаватель: </strong>
                        <select name="professor_id" class="form-control" id="professor_id" required>
                            @foreach ($professor as $professorValue)
                            <option value="{{ $professorValue->id }}">
                                {{ $professorValue->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <strong>День недели: </strong>
                        <select name="dayOfWeek_id" class="form-control" id="dayOfWeek_id" required>
                                @foreach ($dayOfWeek as $dayOfWeekValue)
                                <option value="{{ $dayOfWeekValue->id }}">
                                    {{ $dayOfWeekValue->name }}
                                </option>
                                @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <strong>Время: </strong>
                        <select name="room_id" class="form-control" id="room_id" required>
                            @foreach ($room as $roomValue)
                            <option value="{{ $roomValue->id }}">
                                c {{ $roomValue->begin_time }}
                                по {{ $roomValue->end_time }}
                            </option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>

    </div>

@endsection