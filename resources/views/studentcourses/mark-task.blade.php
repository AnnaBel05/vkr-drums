@extends('welcome')
@section('title', 'Оценить задание')
@section('content')
    <div>
        <div class="container">
            <div class="row">
                <h3> ОЦЕНКА </h3>
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
            <ul class="text-align:center display:inline-block">
                <li class="inline">
                    {{ $result->students->name }}
                </li>
                <li class="inline">
                    @if (pathinfo($result->medias?->link, PATHINFO_EXTENSION) == 'png' ||
                            pathinfo($result->medias?->link, PATHINFO_EXTENSION) == 'jpg')
                        <img src="{{ url('/storage/' . $result->medias->link) }}" width="100">
                    @endif
                </li>
                <div>
                    @if ($result->medias?->link == null)
                        <li class="inline">
                        </li>
                    @elseif ($result->medias?->link != null)
                        <li class="inline">
                            <a class="bttn2" href="{{ url('/storage/' . $result->medias?->link) }}">Скачать</a>
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
                            <label for="mark">Оценка:</label>
                            <input type="number" id="mark" name="mark" min="1" max="10"
                                step="1">
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
