@extends('welcome')
@section('title', 'Расписание')
@section('content')
    <div>
        <div class="container">
            <div class="row">
                <h3> Расписание </h3>
            </div>
        </div>

        <div class="container sm:justify-center">
            <div class="row">
                @foreach ($schedules as $schedule => $scheduleValue)
                    <div>
                        <div>
                            <ul>
                                <li>
                                    {{ $scheduleValue->professors->name }} :
                                </li>
                                <li>
                                    {{ $scheduleValue->daysofweek->name }} :
                                </li>
                                <li>
                                    {{ $scheduleValue->rooms->begin_time ?? '??' }} :
                                </li>
                                <li>
                                    {{ $scheduleValue->rooms->end_time ?? '??' }} 
                                </li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
