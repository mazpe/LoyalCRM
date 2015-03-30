@extends("layout")
@section("content")

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('campaigns') }}">Campaign</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('campaigns') }}">View All Campaigns</a></li>
        <li><a href="{{ URL::to('campaigns/create') }}">Create a Campaign</a>
    </ul>
</nav>

<h1>Showing {{ $campaign->name }}</h1>

    <div class="jumbotron text-center">
        <h2>{{ $campaign->name }}</h2>
        <p>
            <strong>Dealer:</strong> {{ $campaign->dealer->name }}<br>
        </p>
    </div>

@stop

