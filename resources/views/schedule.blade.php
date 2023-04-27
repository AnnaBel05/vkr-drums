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
                <h3>{{ $scheduleValue->professor->name }}</h3>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection