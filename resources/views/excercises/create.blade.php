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

    <form action="{{ route('excercises.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
    
         <div class="row">
            <div class="form-group">
                <strong>Выберите изображение: </strong>
                <input type="file" class="form-control-file" id="media">
            </div>

            <div class="form-group">
                <strong>Студент: </strong>
                <select name="student_id" class="form-control" id="student_id" required>
                    @foreach ($student as $studentValue)
                    <option value="{{ $studentValue->id }}">
                        {{ $studentValue->name }}
                    </option>
                    @endforeach
                </select>
            </div>
    
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>     

@endsection