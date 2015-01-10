@extends("layout")
@section("content")

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('roles') }}">Role</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('roles') }}">View All Roles</a></li>
        <li><a href="{{ URL::to('roles/create') }}">Create a Role</a>
    </ul>
</nav>

<h1>Create a Role</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'roles')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Create the Role!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop

