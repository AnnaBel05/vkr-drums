@extends('welcome')
@section('title', 'View roles')
@section('content')

<div class="container">
    <div class="row">
        @foreach($testtables as $testtableKey)
        <div>
            <div>
                <h3>{{ $testtableKey->notkey ?? 'Not found'}}</h3>
                <h3>{{ $testtableKey->roles->rolename ?? 'Not found'}}</h3>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection