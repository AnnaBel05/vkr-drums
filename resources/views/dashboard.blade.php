@extends('welcome')
@section('title', 'Курс')
@section('content')

    <div class="container3 divdesignwhite">

        <x-app-layout>

            <h1 class="h2style"> Добро пожаловать! </h1> 

            <div class="divdesignwhite">
                <a class="btn btn-success bttnunderline" href="{{ route('schedules.index') }}"> Просмотреть расписание </a>
            </div>

            <x-slot name="header">
            </x-slot>

            <div class="divdesignwhite">
                <a class="btn btn-success bttnunderline" href="{{ route('schedules.index') }}"> Ваши уведомления </a>
            </div>

        </x-app-layout>

    </div>

@endsection
