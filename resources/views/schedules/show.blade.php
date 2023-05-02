@extends('welcome')
@section('title', 'Расписание')
@section('content')
    <div>
        <div class="container">
            <div class="row">
                <h3> </h3>
            </div>
        </div>

        <div>
            <ul class="text-align:center display:inline-block">
                <li>
                    {{ $schedule->professors->name }} :
                </li>
                <li>
                    {{ $schedule->daysofweek->name }} :
                </li>
                <li>
                    {{ $schedule->rooms->begin_time ?? '??' }} :
                </li>
                <li>
                    {{ $schedule->rooms->end_time ?? '??' }} 
                </li>
            </ul>
        </div>
        
    </div>

@endsection