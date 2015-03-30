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

<h1>Create a Disposition</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'dispositions')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('added_by', 'Added_by') }}
        {{ Form::select('added_by_id', $added_by_options , Input::old('added_by_id'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('active', 'Active') }}
        {{ Form::select('active', array('1' => 'Active', '2' => 'Inactive'), Input::old('active'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Create the Disposition!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop
