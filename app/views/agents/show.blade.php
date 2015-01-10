@extends("layout")
@section("content")

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('agents') }}">Agent</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('agents') }}">View All Agents</a></li>
        <li><a href="{{ URL::to('agents/create') }}">Create a Agent</a>
    </ul>
</nav>

<h1>Showing {{ $agent->name }}</h1>

    <div class="jumbotron text-left">
        <h2>{{ $agent->name }}</h2>
        <p>
            <strong>Email:</strong> {{ $agent->email }}<br>
        </p>
    </div>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Dealer</td>
            <td>Name</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($deals as $key => $value)
        <tr>
            <td>{{ $value->dealer->name }}</td>
            <td>{{ $value->name }}</td>
            <td>
                <a class="btn btn-small btn-success" href="{{ URL::to('deals/' . $value->id) }}">Show this Deals</a>
                <a class="btn btn-small btn-info" href="{{ URL::to('deals/' . $value->id . '/edit') }}">Edit this Deals</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>


@stop

