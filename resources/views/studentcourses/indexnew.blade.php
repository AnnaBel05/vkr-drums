@extends('welcome')
@section('title', 'Курс')
@section('content')

<div>
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
</div>     

@endsection