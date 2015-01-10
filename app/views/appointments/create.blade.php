@extends("layout")
@section("content")

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('appointments') }}">Appointment</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('appointments') }}">View All Appointments</a></li>
        <li><a href="{{ URL::to('appointments/create') }}">Create a Appointment</a>
    </ul>
</nav>

<h1>Create a Appointment</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'appointments')) }}

    <div class="form-group">
        {{ Form::label('deal_id', 'Deal') }}
        {{ Form::select('deal_id', $deals , Input::old('deal_id'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('appointment_date', 'Appointment Date') }}
        {{ Form::text('appointment_date', Input::old('appointment_date'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('added_by_id', 'Added By') }}
        {{ Form::select('added_by_id', $added_by , null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('active', 'Active') }}
        {{ Form::select('active', array('1' => 'Active', '2' => 'Inactive'), null, array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Create the Appointment!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop

