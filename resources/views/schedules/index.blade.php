@extends('welcome')
@section('title', 'Расписание')
@section('content')
    <div>
        <div class="container">
            <div class="row">
                <h3> Расписание </h3>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="relative sm:flex container width:80% sm:items-center sm:justify-center bg-gray-100">
            <div class="row">
                @foreach ($schedules as $schedule => $scheduleValue)
                    <div>
                        <div>
                            <ul class="text-align:center display:inline-block">
                                <li class="inline">
                                    {{ $scheduleValue->professors->name }} :
                                </li>
                                <li class="inline">
                                    {{ $scheduleValue->daysofweek->name }} :
                                </li>
                                <li class="inline">
                                    {{ $scheduleValue->rooms->begin_time ?? '??' }} :
                                </li>
                                <li class="inline">
                                    {{ $scheduleValue->rooms->end_time ?? '??' }} 
                                </li>
                                <li class="inline">
                                    <a class="btn btn-info" href="{{ route('schedules.show',$scheduleValue->id) }}">Show</a>
                                </li>
                                <li class="inline">
                                    <a class="btn btn-primary" href="{{ route('schedules.edit',$scheduleValue->id) }}">Edit</a>
                                </li>
                                <li class="inline">
                                    <form action="{{ route('schedules.destroy',$scheduleValue->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
