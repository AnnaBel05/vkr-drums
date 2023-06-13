@extends('welcome')

@section('title', 'Курс')
@section('content')

<div class="container3 divdesignwhite">
    <div class="container">
        <div class="row">
            <h1 class="h2style"> Создать курс </h1>    
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <form action="{{ route('studentcourses.store') }}" method="POST">
        @csrf
        <div>
            <br>
        </div>
    
         <div class="row">
            @if (Auth::user()->role_id == 3)
            <div class="form-group">
                <strong>Выберите преподавателя:</strong>
                        <input type="text" id="professor_input" list="professor_list" required>
                        <input type="hidden" id="professor_id" name="professor_id" required>
                        <datalist id="professor_list">
                            @foreach ($professor as $professorValue)
                                <option value="{{ $professorValue->last_name }}" data-professor-id="{{ $professorValue->id }}">
                                    {{ $professorValue->full_name }} {{ $professorValue->patronymic }}
                                </option>
                            @endforeach
                        </datalist>
            </div>
            @endif

            <div>
                <br>
            </div>

            <div class="row">
                <strong> Введите название курса: </strong>
                <input type="text" name="name" id="name" required>
            </div>

            <div>
                <br>
            </div>
    
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary bttnbold">Подтвердить</button>
            </div>
        </div>
    </form>
</div>     

@endsection