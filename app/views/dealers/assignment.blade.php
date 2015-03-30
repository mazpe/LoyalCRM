@extends("layout")
@section("content")

@if (Auth::user()->hasRole('Admin'))
<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('dealers') }}">Dealer</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('dealers/'. $dealer->id .'/create_month') }}">Create a Month</a>
        <li><a href="{{ URL::to('dealers/'. $dealer->id .'/assignment') }}">Assignment</a>
    </ul>
</nav>
@endif

<h3>
<a href="{{ URL::to('dealers/'.$dealer->id.'/month/'. date('m') ) }}">{{ $dealer->name }} </a>
- Assignment
</h3>

{{ HTML::ul($errors->all()) }}

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<div class="criteria" >
<br />
{{ Form::open(array('url' => 'dealers/assignment/search')) }}
{{ Form::hidden('dealer_id', $dealer->id) }}
<table class="table table-striped table-bordered">
    <tbody>
        <tr>
            <td>
<fieldset>
    <legend>
    <strong><font color="blue"><small>Assignment</small></font></strong>
    </legend>
    <div class="form-group">
        {{ Form::label('agent_id', 'Agent') }}
        {{ Form::select('agent_id', $agents , 'null') }}
&nbsp;&nbsp;&nbsp;&nbsp;
        {{ Form::label('month_id', 'Month') }}
        {{ Form::select('month_id', $months , 'null') }}
    </div>
</fieldset>
<fieldset>
    <legend>
    <strong><font color="blue"><small>Dates</small></font></strong>
    </legend>
    <div class="form-group">
        {{ Form::label('purchase_date_from', 'Purchase Date From:') }}
        {{ Form::text('purchase_date_from', Input::old('purchase_date_from'), array('id' => 'purchase_date_from')) }}
        {{ Form::text('purchase_date_to', Input::old('purchase_date_to'), array('id' => 'purchase_date_to')) }}
&nbsp;&nbsp;&nbsp;&nbsp;
    </div>
    <div class="form-group">
        {{ Form::label('lastvisit_from', 'Last Visit:') }}
        {{ Form::text('lastvisit_from', Input::old('lastvisit_from'), array('id' => 'lastvisit_from')) }}
        {{ Form::text('lastvisit_to', Input::old('lastvisit_to'), array('id' => 'lastvisit_to')) }}
&nbsp;&nbsp;&nbsp;&nbsp;
        {{ Form::label('lastcalled_from', 'Last Called:') }}
        {{ Form::text('lastcalled_from', Input::old('lastcalled_from'), array('id' => 'lastcalled_from')) }}
        {{ Form::text('lastcalled_to', Input::old('lastcalled_to'), array('id' => 'lastcalled_to')) }}
&nbsp;&nbsp;&nbsp;&nbsp;
        {{ Form::label('nevercalled', 'Never Called:') }}
        {{ Form::checkbox('nevercalled','yes', true) }}
    </div>
</fieldset>
<fieldset>
    <legend>
    <strong><font color="blue"><small>Vehicle</small></font></strong>
    </legend>
    <div class="form-group">
        {{ Form::label('year', 'Years:') }}
        {{ Form::text('year_from', Input::get('year_from'), null) }}
        {{ Form::text('year_to', Input::get('year_to'), null) }}
&nbsp;&nbsp;&nbsp;&nbsp;
        {{ Form::label('make', 'Make:') }}
        {{ Form::text('make', Input::get('make'), null) }}
&nbsp;&nbsp;&nbsp;&nbsp;
        {{ Form::label('miles', 'Miles:') }}
        {{ Form::text('miles_from', Input::get('miles_from'), null) }}
        {{ Form::text('miles_to', Input::get('miles_to'), null) }}
    </div>
</fieldset>
<fieldset>
    <legend>
    <strong><font color="blue"><small>Sorting</small></font></strong>
    </legend>
    <div class="form-group">
        {{ Form::label('sort', 'Sort 1:') }}
        {{ Form::select('sort1', array ('name' => 'Name','vehicle_vin' => 'VIN',  'vehicle_year' => 'Year','vehicle_make' => 'Make','vehicle_mileage' => 'Miles','purchase_date' => 'Purchased', 'last_visit' => 'Last Visit', 'last_called' => 'Last Called') , Input::old('sort1')) }}
        {{ Form::select('sort1_direction', array ('ASC' => 'ASC', 'DESC' => 'DESC') , Input::old('sort1_direction')) }}
&nbsp;&nbsp;&nbsp;&nbsp;
        {{ Form::label('sort', 'Sort 2:') }}
        {{ Form::select('sort2', array ('' => '', 'name' => 'Name','vehicle_vin' => 'VIN',  'vehicle_year' => 'Year','vehicle_make' => 'Make','vehicle_mileage' => 'Miles','purchase_date' => 'Purchased', 'last_visit' => 'Last Visit', 'last_called' => 'Last Called') , Input::old('sort2')) }}
        {{ Form::select('sort2_direction', array ('ASC' => 'ASC', 'DESC' => 'DESC') , Input::old('sort2_direction')) }}
&nbsp;&nbsp;&nbsp;&nbsp;
        {{ Form::label('sort', 'Sort 3:') }}
        {{ Form::select('sort3', array ('' => '', 'name' => 'Name','vehicle_vin' => 'VIN',  'vehicle_year' => 'Year','vehicle_make' => 'Make','vehicle_mileage' => 'Miles','purchase_date' => 'Purchased', 'last_visit' => 'Last Visit', 'last_called' => 'Last Called') , Input::old('sort3')) }}
        {{ Form::select('sort3_direction', array ('ASC' => 'ASC', 'DESC' => 'DESC') , Input::old('sort3_direction')) }}
    </div>
</fieldset>


    <div class="form-group">
        {{ Form::submit('Search!', array('class' => 'btn btn-primary')) }}
    </div>
            </td>
        </tr>
    </tbody>
</table>
{{ Form::close() }}
</div>

@stop
