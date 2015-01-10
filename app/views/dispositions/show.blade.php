@extends("layout")
@section("content")

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('dispositions') }}">Disposition</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('dispositions') }}">View All Dispositions</a></li>
        <li><a href="{{ URL::to('dispositions/create') }}">Create a Disposition</a>
    </ul>
</nav>

<h1>Showing {{ $disposition->name }}</h1>

    <div class="jumbotron text-left">
        <h2>{{ $disposition->name }}</h2>
        <p>
            <strong>Added By:</strong> {{ $disposition->added_by_id }}<br>
            <strong>Active:</strong> {{ $disposition->active }}
        </p>
    </div>
@stop
