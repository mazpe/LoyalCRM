@extends("layout")
@section("content")

<nav class="navbar navbar-inverse">
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('dealergroups/create') }}">Create Dealer Group</a>
        <li><a href="{{ URL::to('dealers/create') }}">Create Dealer</a>
    </ul>
</nav>

<h1>Create a Dealer Group</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'dealergroups')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('address_1', 'Address 1') }}
        {{ Form::text('address_1', Input::old('address_1'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('address_2', 'Address 2') }}
        {{ Form::text('address_2', Input::old('address_2'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('city', 'City') }}
        {{ Form::text('city', Input::old('city'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('state', 'State') }}
        {{ Form::text('state', Input::old('state'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('zip', 'Zip') }}
        {{ Form::text('zip', Input::old('zip'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('phone', 'Phone') }}
        {{ Form::text('phone', Input::old('phone'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('fax', 'Fax') }}
        {{ Form::text('fax', Input::old('fax'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::text('email', Input::old('email'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('contact', 'Contact') }}
        {{ Form::text('contact', Input::old('contact'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('contact_phone', 'Contact Phone') }}
        {{ Form::text('contact_phone', Input::old('contact_phone'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('contact_email', 'Contact Email') }}
        {{ Form::text('contact_email', Input::old('contact_email'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('active', 'Active') }}
        {{ Form::select('active', array('1' => 'Active', '2' => 'Inactive'), Input::old('active'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Create the Dealer Group!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop
