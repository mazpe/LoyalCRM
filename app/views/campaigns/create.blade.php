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

<h1>Create a Campaign</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'campaigns')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('dealer_id', 'Dealer') }}
        {{ Form::select('dealer_id', $dealer_options , Input::old('dealer_id'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('added_by_id', 'Added By') }}
        {{ Form::select('added_by_id', $added_by_options , null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('active', 'Active') }}
        {{ Form::select('active', array('1' => 'Active', '2' => 'Inactive'), null, array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Create the Campaign!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop

