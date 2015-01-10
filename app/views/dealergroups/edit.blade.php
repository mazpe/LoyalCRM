@extends("layout")
@section("content")

<nav class="navbar navbar-inverse">
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('dealergroups/create') }}">Create Dealer Group</a>
        <li><a href="{{ URL::to('dealers/create') }}">Create Dealer</a>
    </ul>
</nav>


<h1>Edit {{ $dealergroup->name }}</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($dealergroup, array('route' => array('dealergroups.update', $dealergroup->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('address_1', 'Address 1') }}
        {{ Form::text('address_1', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('address_2', 'Address 2') }}
        {{ Form::text('address_2', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('city', 'City') }}
        {{ Form::text('city', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('state', 'State') }}
        {{ Form::text('state', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('zip', 'Zip') }}
        {{ Form::text('zip', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('phone', 'Phone') }}
        {{ Form::text('phone', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('fax', 'Fax') }}
        {{ Form::text('fax', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::text('email', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('contact', 'Contact') }}
        {{ Form::text('contact', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('contact_phone', 'Contact Phone') }}
        {{ Form::text('contact_phone', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('contact_email', 'Contact Email') }}
        {{ Form::text('contact_email', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('active', 'Active') }}
        {{ Form::select('active', array('1' => 'Active', '2' => 'Inactive'), null, array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Edit the Dealer Group!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop
