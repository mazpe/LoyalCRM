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

<h1>Edit {{ $campaign->name }}</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($campaign, array('route' => array('campaigns.update', $campaign->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('dealer_id', 'Dealer') }}
        {{ Form::select('dealer_id', $dealer_options , null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('added_by_id', 'Added By') }}
        {{ Form::select('added_by_id', $added_by_options , null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('active', 'Active') }}
        {{ Form::select('active', array('1' => 'Active', '2' => 'Inactive'), null, array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Edit the Campaign!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop

