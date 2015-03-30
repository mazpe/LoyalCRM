@extends("layout")
@section("content")

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('deals') }}">Deal</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('deals') }}">View All Deals</a></li>
        <li><a href="{{ URL::to('deals/create') }}">Create a Deal</a>
    </ul>
</nav>

<h1>Edit {{ $deal->name }}</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($deal, array('route' => array('deals.update', $deal->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('dealer_id', 'Dealer') }}
        {{ Form::select('dealer_id', $dealers , null, array('class' => 'form-control')) }}
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
        {{ Form::label('stock_number', 'Stock Number') }}
        {{ Form::text('stock_number', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('vehicle_year', 'Vehicle Year') }}
        {{ Form::text('vehicle_year', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('vehicle_make', 'Vehicle Make') }}
        {{ Form::text('vehicle_make', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('vehicle_model', 'Vehicle Model') }}
        {{ Form::text('vehicle_model', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('vehicle_color', 'Vehicle Color') }}
        {{ Form::text('vehicle_color', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('vehicle_mileage', 'Vehicle Mileage') }}
        {{ Form::text('vehicle_mileage', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('added_by_id', 'Added By') }}
        {{ Form::select('added_by_id', $added_by, null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('active', 'Active') }}
        {{ Form::select('active', array('1' => 'Active', '2' => 'Inactive'), null, array('class' => 'form-control')) }}
    </div>

<h1>Call Details</h1>
    <div class="form-group">
        {{ Form::label('diposition_id', 'Disposition') }}
        {{ Form::select('disposition_id', $dispositions, null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('call_1', 'Call 1') }}
        {{ Form::text('call_1', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('call_1_result', 'Call 1 Result') }}
        {{ Form::text('call_1_result', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('call_2', 'Call 2') }}
        {{ Form::text('call_2', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('call_2_result', 'Call 2 Result') }}
        {{ Form::text('call_2_result', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('call_3', 'Call 3') }}
        {{ Form::text('call_3', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('call_3_result', 'Call 3 Result') }}
        {{ Form::text('call__result3', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('call_4', 'Call 4') }}
        {{ Form::text('call_4', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('call_4_result', 'Call 4 Result') }}
        {{ Form::text('call_4_result', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('call_5', 'Call 5') }}
        {{ Form::text('call_5', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('call_5_result', 'Call 5 Result') }}
        {{ Form::text('call_5_result', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('call_6', 'Call 6') }}
        {{ Form::text('call_6', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('call_6_result', 'Call 6 Result') }}
        {{ Form::text('call_6_result', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('call_7', 'Call 7') }}
        {{ Form::text('call_7', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('call_7_result', 'Call 7') }}
        {{ Form::text('call_7_result', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('call_8', 'Call 8') }}
        {{ Form::text('call_8', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('call_8_result', 'Call 8') }}
        {{ Form::text('call_8_result', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('final_results', 'Final Results') }}
        {{ Form::select('final_results', $dispositions, null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('last_visit', 'Last Visit') }}
        {{ Form::text('last_visit', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('appointment', 'Appointment') }}
        {{ Form::text('appointment', null, array('class' => 'form-control')) }}
    </div>
    {{ Form::submit('Edit the Deal!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop

