<!DOCTYPE html>
<head>
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" charset="utf-8">
    <style>
    {
        box-sizing: border-box;
    }
    /* Set additional styling options for the columns*/
    .column {
    float: left;
    width: 200px;
    }
    .row:after {
    content: "";
    display: table;
    clear: both;
    }
    </style>
</head>
<html>

    <body>
        <h1> MAIN PAGE </h1>

        <div>
            <a href="{{ url('view-roles') }}"> Список </a>
        </div>

        <!-- <div>
            <a href="{{ url('favourites') }}">Избранное</a>
        </div>
        <div>
            <a href="{{ url('compare') }}">Сравнение</a>
        </div> -->

        <div class="container page">
        @yield('content')
        </div>
        @yield('scripts')
    </body>

</html>