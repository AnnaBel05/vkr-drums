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

    <form action="{{ route('studentcourses.store') }}" method="POST">
        @csrf
    
         <div class="row">
            <div class="form-group">
                <strong>Преподаватель: </strong>
                <select name="professor_id" class="form-control" id="professor_id" enctype="multipart/form-data" required>
                    @foreach ($professor as $professorValue)
                    <option value="{{ $professorValue->id }}">
                        {{ $professorValue->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- <div class="form-group">
                <strong>Студент: </strong>
                <select name="student_id" class="form-control" id="student_id" required>
                    @foreach ($student as $studentValue)
                    <option value="{{ $studentValue->id }}">
                        {{ $studentValue->name }}
                    </option>
                    @endforeach
                </select>
            </div> --}}

            {{-- <div class="form-group">
                <strong>Студент: </strong>
                <input id="custom_field1" name="custom_field1" type="text" list="datastudent_id" class="form-control">
                <datalist name="datastudent_id" id="datastudent_id" required>
                    @foreach ($student as $studentValue)
                    <option value="{{ $studentValue->id }}">
                        {{ $studentValue->name }}
                    </option>
                    @endforeach
                </datalist>
            </div> --}}
    
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>     

@endsection