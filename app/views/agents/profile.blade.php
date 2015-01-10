@extends("layout")
@section("content")

<?php
$i = 1;
?>

<nav class="navbar navbar-inverse">
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('directions') }}">Plan Route</a>
        <li><a href="{{ URL::to('dealergroups/create') }}">Create Dealer Group</a>
        <li><a href="{{ URL::to('dealers/create') }}">Create Dealer</a>
    </ul>
</nav>
<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif


<h1><font color="#FF6600">{{ $agent->name }}</font></h1>
<button class="hide-show-agent-button">Hide/Show</button>

<div class="hide-show-agent" style="display:none">
<br />

    <div class="jumbotron text-left">
        <h2>{{ $agent->name }}</h2>
        <p>
            <strong>Email:</strong> {{ $agent->email }}<br>
        </p>
    </div>
</div>

<br>
<br>

<b>PROFILE STATS</b> coming soon. Please click on  
<a href="{{ URL::to('agents/'. Auth::user()->id) .'/leads' }}">
<b>'LEADS'</b>
</a>
here or on the Top Menu for your customers details.
<h3>Marketing Materials</h3>
<ul>
    <li><a href="#">Brochure</a></li>
    <li><a href="#">Brochure Insert</a></li>
    <li><a href="#">Dealer Agreement</a></li>
    <li><a href="#">Service Call Information</a></li>
</ul>

<br>
<br>
<br>
<br>

@stop

