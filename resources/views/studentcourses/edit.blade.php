@extends('welcome')
@section('title', 'Добавить задание')
@section('content')
    <div>
        <div class="container">
            <div class="row">
                <h3> Расписание </h3>
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

        <form action="{{ route('studentcourses.update', $studentcourse->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="row">
                        <div class="form-group">
                            <strong>Выберите файл: </strong>
                            <input type="file" class="form-control-file" name="media" id="media">
                        </div>

                        <div class="form-group">
                            <strong>Введите задание: </strong>
                            <textarea rows="5" cols="50" name="theory" id="theory"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>

    </div>

@endsection