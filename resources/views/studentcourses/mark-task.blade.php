@extends('welcome')
@section('title', 'Оценить задание')
@section('content')
    <div class="container3 divdesignwhite">
        <div class="container">
            <div class="row">
                <h1 class="h2style"> Оценивание ответа </h1>    
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

        <div>
            <br>
        </div>

        <div>
            <ul class="text-align:center display:inline-block">
                <li class="inline">
                    <b> Студент: </b> {{ trim($result->students->last_name) }} {{ mb_substr($result->students->full_name, 0, 1) }}. {{ mb_substr($result->students->patronymic, 0, 1) }}.
                </li>
                <li class="inline">
                    @if (pathinfo($result->medias?->link, PATHINFO_EXTENSION) == 'png' ||
                            pathinfo($result->medias?->link, PATHINFO_EXTENSION) == 'jpg')
                        <img src="{{ url('/storage/' . $result->medias->link) }}">
                    @endif
                </li>
                
                <div>
                    @if ($result->medias?->link == null)
                        <li class="inline">
                        </li>
                    @elseif ($result->medias?->link != null)
                        <li class="inline">
                            <a class="bttnunderline" href="{{ url('/storage/' . $result->medias?->link) }}">Скачать</a>
                        </li>
                    @endif
                </div>
            </ul>
        </div>

        <form action="{{ route('studentcourses.save-mark', $result->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="row">
                        <div class="form-group">
                            <label for="mark"> <b> Оценка (от 1 до 10): </b></label>
                            <input type="number" id="mark" name="mark" min="1" max="10"
                                step="1">
                        </div>
                    </div>
                </div>
                <div>
                    <br>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary bttnbold">Оценить</button>
                </div>
            </div>
        </form>

    </div>

@endsection
