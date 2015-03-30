@extends("layout")
@section("content")

<h1>Reports</h1>

<ul>
@if (Auth::user()->hasRole('Agent'))
    <li><a href="{{ URL::to('reports/agents/'.$user->id) }}">Agent Calls and Appointments Stats</a></li>

@endif
<ul>

@stop
