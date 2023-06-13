@extends('welcome')
@section('title', 'Добавить задание')
@section('content')
    <div class="container3 divdesignwhite">
        <div class="container">
            <div class="row">
                <h1 class="h2style"> Прикрепить ответ на задание </h1>    
            </div>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('studentcourses.update-task', $excercise->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="row">
                        <div>
                            <br>
                            <strong> Выберите файл: </strong>
                        </div>

                        <div class="form-group">
                            {{-- <strong>Выберите файл: </strong> --}}
                            <input type="file" class="form-control-file" name="media" id="media">
                        </div>


                        {{-- <div class="form-group">
                            <strong>Введите задание: </strong>
                            <textarea rows="5" cols="50" name="theory" id="theory"></textarea>
                        </div> --}}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <br>
                    <button type="submit" class="btn btn-primary bttnbold">Отправить</button>
                </div>
            </div>
        </form>

    </div>

@endsection