@extends('welcome')
@section('title', 'Расписание')
@section('content')

<div class="container">
    <div class="row">
        <h3> Расписание </h3> 
    </div>
</div>

<div class="container">
    <div class="row">
        @foreach($schedules as $schedule => $scheduleValue)
        <div>
            <div>
                <h3>{{ $scheduleValue->professors->name }}</h3>
                <h3>{{ $scheduleValue->daysofweek->name }}</h3>
                <h3>{{ $scheduleValue->room->begin_time }}</h3>
                <h3>{{ $scheduleValue->room->end_time }}</h3>

            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection