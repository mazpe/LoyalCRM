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

<h1>Edit {{ $disposition->name }}</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($disposition, array('route' => array('dispositions.update', $disposition->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('added_by_id', 'Added By') }}
        {{ Form::select('added_by_id', $added_by_options , null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('active', 'Active') }}
        {{ Form::select('active', array('1' => 'Active', '2' => 'Inactive'), null, array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Edit the Disposition!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop
