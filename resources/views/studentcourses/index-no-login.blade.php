@extends('welcome')
@section('title', 'Курс')
@section('content')

<div class="container3 divdesignwhite">
    <div class="container">
        <div class="row">
            <h1 class="h2style"> Курс </h1> 
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div>
        <h1 class="h2style"> ВЫ НЕ ВОШЛИ В АККАУНТ </h1>
    </div>
</div>     

@endsection