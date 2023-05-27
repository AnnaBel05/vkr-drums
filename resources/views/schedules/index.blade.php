@extends('welcome')
@section('title', 'Расписание')
@section('content')

    @php
        $weekday = null;
    @endphp

    <div class="container3">
        <div>
            <div class="row">
                <h3> Расписание </h3>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('schedules.create') }}"> Обновить расписание </a>
            </div>
        </div>

        <div>
            <form action="{{ route('schedules.index') }}" method="GET">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="professor_filter">Filter by Professor:</label>
                        <select name="professor_filter" id="professor_filter" class="form-control">
                            <option value="">All Professors</option>
                            @foreach ($professors as $professor)
                                <option value="{{ $professor->id }}">{{ $professor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="student_filter">Filter by Student:</label>
                        <select name="student_filter" id="student_filter" class="form-control">
                            <option value="">All Students</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Apply Filters</button>
            </form>
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
                                        <li class="inline">
                                            {{ $scheduleValue->professors->name }} -
                                        </li>
                                        <li class="inline">
                                            {{ $scheduleValue->students->name }} -
                                        </li>
                                        <li class="inline">
                                            {{-- {{ $scheduleValue->daysofweek->name }} : --}}
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
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
