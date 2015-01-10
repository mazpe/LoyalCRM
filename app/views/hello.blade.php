@extends("layout")
@section("content")

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('campaigns') }}">Campaigns</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('campaigns') }}">View All Campaigns</a></li>
        <li><a href="{{ URL::to('campaigns/create') }}">Create a Campaigns</a>
    </ul>
</nav>

<h1>All the Campaigns</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

WELCOM

@stop
