@extends('main')
@section('title', 'View roles')
@section('content')

<div class="container">
    <div class="row">
        @foreach($roles as $role)
        <div>
            <div>
                <p>{{ $role->rolename }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection