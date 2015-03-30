@extends("layout")
@section("content")

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('permissions') }}">Permission</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('permissions') }}">View All Permissions</a></li>
        <li><a href="{{ URL::to('permissions/create') }}">Create a Permission</a>
    </ul>
</nav>

<h1>Create a Permission</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'permissions')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('added_by_id', 'Added By') }}
        {{ Form::select('added_by_id', $added_by , null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('active', 'Active') }}
        {{ Form::select('active', array('1' => 'Active', '2' => 'Inactive'), null, array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Create the Permission!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop

