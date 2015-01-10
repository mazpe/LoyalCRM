@extends("layout")
@section("content")

<nav class="navbar navbar-inverse">
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('dealergroups/create') }}">Create Dealer Group</a>
        <li><a href="{{ URL::to('dealers/create') }}">Create Dealer</a>
    </ul>
</nav>

<h2>Edit {{ $dealer->name }}</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($dealer, array('route' => array('dealers.update', $dealer->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('dealer_group_id', 'Dealer Group') }}
        {{ Form::select('dealer_group_id', $dealer_groups , null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('manufacture_id', 'Manufacture') }}
        {{ Form::select('manufacture_id', $manufactures , null, array('class' => 'form-control')) }}
    </div>

@if (Auth::user()->hasRole('Agent'))
    {{ Form::hidden('agent_id', Auth::user()->id) }}
@elseif (Auth::user()->hasRole('Admin'))
    <div class="form-group">
        {{ Form::label('agent_id', 'Loyal Customer Strategist') }}
        {{ Form::select('agent_id', $agents , Input::old('agent_id'),
            array('class' => 'form-control')) }}
    </div>
@endif

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
        {{ Form::label('website', 'Website') }}
        {{ Form::text('website', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('owner', 'Owner') }}
        {{ Form::text('owner', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('owner_phone', 'Owner Phone') }}
        {{ Form::text('owner_phone', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('owner_email', 'Owner Email') }}
        {{ Form::text('owner_email', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('general_manager', 'General Manager') }}
        {{ Form::text('general_manager', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('general_manager_phone', 'General Manager Phone') }}
        {{ Form::text('general_manager_phone', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('general_manager_email', 'General Manager Email') }}
        {{ Form::text('general_manager_email', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('service_manager', 'Service Manager') }}
        {{ Form::text('service_manager', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('service_manager_phone', 'Service Manager Phone') }}
        {{ Form::text('service_manager_phone', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('service_manager_email', 'Service Manager Email') }}
        {{ Form::text('service_manager_email', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('note', 'Note') }}
        {{ Form::text('note', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('active', 'Active') }}
        {{ Form::select('active', array('1' => 'Active', '2' => 'Inactive'), null, array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Edit the Dealer!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop
