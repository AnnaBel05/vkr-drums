@extends('welcome')
@section('title', 'Курс')
@section('content')

<div class="container3 divdesignwhite">
    <div class="container">
        <div class="row">
            <h3> Course </h3>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div>
        <h1> ВЫ НЕ ПРИВЯЗАНЫ К КУРСУ :З</h1>
    </div>

    <div class="pull-right">
        <a class="btn btn-success" href="{{ route('studentcourses.create') }}"> Записаться на курс </a>
    </div>
</div>     

@endsection