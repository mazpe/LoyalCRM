@extends("layout")
@section("content")

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('manufactures') }}">Manufacture</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('manufactures') }}">View All Manufactures</a></li>
        <li><a href="{{ URL::to('manufactures/create') }}">Create a Manufacture</a>
    </ul>
</nav>

<h1>Edit {{ $manufacture->name }}</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($manufacture, array('route' => array('manufactures.update', $manufacture->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('active', 'Active') }}
        {{ Form::select('active', array('1' => 'Active', '2' => 'Inactive'), null, array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Edit the Manufacture!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop
