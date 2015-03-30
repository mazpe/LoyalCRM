@extends("layout")
@section("content")

<nav class="navbar navbar-inverse">
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('dealergroups/create') }}">Create Dealer Group</a>
        <li><a href="{{ URL::to('dealers/create') }}">Create Dealer</a>
    </ul>
</nav>


<h1>Create a Dealer</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'dealers')) }}

    <div class="form-group">
        {{ Form::label('dealer_group_id', 'Dealer Group') }}
        {{ Form::select('dealer_group_id', $dealer_groups , Input::old('dealer_group_id'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('manufacture_id', 'Manufacture') }}
        {{ Form::select('manufacture_id', $manufactures , Input::old('manufacture_id'), array('class' => 'form-control')) }}
    </div>

@if (Auth::user()->hasRole('Agent'))
    {{ Form::hidden('agent_id', Auth::user()->id) }}
@else
    <div class="form-group">
        {{ Form::label('agent_id', 'Loyal Customer Strategist') }}
        {{ Form::select('agent_id', $agents , Input::old('agent_id'), 
            array('class' => 'form-control')) }}
    </div>
@endif
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
        {{ Form::label('website', 'Website') }}
        {{ Form::text('website', Input::old('website'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('owner', 'Owner') }}
        {{ Form::text('owner', Input::old('owner'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('owner_phone', 'Owner Phone') }}
        {{ Form::text('owner_phone', Input::old('owner_phone'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('owner_email', 'Owner Email') }}
        {{ Form::text('owner_email', Input::old('owner_email'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('general_manager', 'General Manager') }}
        {{ Form::text('general_manager', Input::old('general_manager'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('general_manager_phone', 'General Manager Phone') }}
        {{ Form::text('general_manager_phone', Input::old('general_manager_phone'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('general_manager_email', 'General Manager Email') }}
        {{ Form::text('general_manager_email', Input::old('general_manager_email'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('service_manager', 'Service Manager') }}
        {{ Form::text('service_manager', Input::old('service_manager'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('service_manager_phone', 'Service Manager Phone') }}
        {{ Form::text('service_manager_phone', Input::old('service_manager_phone'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('service_manager_email', 'Service Manager Email') }}
        {{ Form::text('service_manager_email', Input::old('service_manager_email'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('active', 'Active') }}
        {{ Form::select('active', array('1' => 'Active', '2' => 'Inactive'), Input::old('active'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Create the Dealer!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop
