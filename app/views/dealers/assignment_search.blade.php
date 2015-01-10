@extends("layout")
@section("content")

    <script type="text/javascript">
      function countCheckboxes ( ) {
        var form = document.getElementById('testForm');
        var count = 0;
        for(var n=0;n < form.length;n++){
          if(form[n].checked){
            count++;
          }
        }
        document.getElementById('checkCount').innerHTML = count;
      }
      window.onload = countCheckboxes;
    </script>


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

<h1>
<a href="{{ URL::to('dealers/'.$dealer->id.'/month/'. date('m') ) }}">{{ $dealer->name }} </a>
- Assignment
</h1>


<h1>Search</h1>
<button class="hidetext">Hide/Show</button>

<div class="criteria" style="display:none">
<br />

{{ Form::open(array('url' => 'dealers/assignment/search')) }}
{{ Form::hidden('dealer_id', $dealer->id) }}

<table class="table table-striped table-bordered">
    <tbody>
        <tr>
            <td>
    <div class="form-group">
        {{ Form::label('agent_id', 'Agent') }}
        {{ Form::select('agent_id', $agents , Input::old('agent_id'), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('month_id', 'Month') }}
        {{ Form::select('month_id', $months , Input::old('month_id'), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('purchase_date_from', 'Purchase Date:') }}
        {{ Form::text('purchase_date_from', Input::old('purchase_date_from'), array('id' => 'purchase_date_from')) }}
        {{ Form::text('purchase_date_to', Input::old('purchase_date_to'), array('id' => 'purchase_date_to')) }}
    </div>
    <div class="form-group">
        {{ Form::label('lastvisit_from', 'Last Visit:') }}
        {{ Form::text('lastvisit_from', Input::old('lastvisit_from'), array('id' => 'lastvisit_from') ) }}
        {{ Form::text('lastvisit_to', Input::old('lastvisit_to'), array('id' => 'lastvisit_to')) }}
    </div>
    <div class="form-group">
        {{ Form::label('lastcalled_from', 'Last Called:') }}
        {{ Form::text('lastcalled_from', Input::old('lastcalled_from'), array('id' => 'lastcalled_from')) }}
        {{ Form::text('lastcalled_to', Input::old('lastcalled_to'), array('id' => 'lastcalled_to')) }}
&nbsp;&nbsp;&nbsp;&nbsp;
        {{ Form::label('nevercalled', 'Never Called:') }}
        {{ Form::checkbox('nevercalled','yes') }}
    </div>
    <div class="form-group">
        {{ Form::label('year', 'Years:') }}
        {{ Form::text('year_from', Input::get('year_from'), null) }}
        {{ Form::text('year_to', Input::get('year_to'), null) }}
    </div>
    <div class="form-group">
        {{ Form::label('make', 'Make:') }}
        {{ Form::text('make_from', Input::get('make_from'), null) }}
        {{ Form::text('make_to', Input::get('make_to'), null) }}
    </div>
    <div class="form-group">
        {{ Form::label('miles', 'Miles:') }}
        {{ Form::text('miles_from', Input::get('miles_from'), null) }}
        {{ Form::text('miles_to', Input::get('miles_to'), null) }}
    </div>
    <div class="form-group">
        {{ Form::label('sort', 'Sort 1:') }}
        {{ Form::select('sort1', array ('name' => 'Name','vehicle_vin' => 'VIN', 'vehicle_year' => 'Year','vehicle_mileage' => 'Miles','purchase_date' => 'Purchased', 'last_visit' => 'Last Visit', 'last_called' => 'Last Called') , Input::old('sort1')) }}
        {{ Form::select('sort1_direction', array ('ASC' => 'ASC', 'DESC' => 'DESC') , Input::old('sort1_direction')) }}
&nbsp;&nbsp;&nbsp;&nbsp;
        {{ Form::label('sort', 'Sort 2:') }}
        {{ Form::select('sort2', array ('' => '', 'name' => 'Name','vehicle_vin' => 'VIN', 'vehicle_year' => 'Year', 'vehicle_mileage' => 'Miles','purchase_date' => 'Purchased', 'last_visit' => 'Last Visit', 'last_called' => 'Last Called') , Input::old('sort2')) }}
        {{ Form::select('sort2_direction', array ('ASC' => 'ASC', 'DESC' => 'DESC') , Input::old('sort2_direction')) }}
&nbsp;&nbsp;&nbsp;&nbsp;
        {{ Form::label('sort', 'Sort 3:') }}
        {{ Form::select('sort3', array ('' => '', 'name' => 'Name','vehicle_vin' => 'VIN', 'vehicle_year' => 'Year', 'vehicle_mileage' => 'Miles','purchase_date' => 'Purchased', 'last_visit' => 'Last Visit', 'last_called' => 'Last Called') , Input::old('sort3')) }}
        {{ Form::select('sort3_direction', array ('ASC' => 'ASC', 'DESC' => 'DESC') , Input::old('sort3_direction')) }}
    </div>


    <div class="form-group">
        {{ Form::submit('Search!', array('class' => 'btn btn-primary')) }}
    </div>
            </td>
        </tr>
    </tbody>
</table>
{{ Form::close() }}
</div>
<br/>
<h1>Assignment</h1>
<button class="hide-setcampaign">Hide/Show</button>

<div class="setcampaign" style="display:none">
<br />

{{ Form::open(array('url' => 'dealers/assignment/setcampaign','name' => 'testForm', 'id' => 'testForm')) }}
{{ Form::hidden('dealer_id', $dealer->id) }}
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Month</td>
            <td>Agent</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                {{ Form::label('month_id', 'Month') }}
                {{ Form::select('month_id', $assigned_months , null, array('class' => 'form-control')) }}
            </td>
            <td>
                <div class="form-group">
                {{ Form::label('agent_id', 'Agent') }}
                {{ Form::select('agent_id', $agents , null, array('class' => 'form-control')) }}
                </div>
            </td>

            <td>
                {{ Form::submit('Assign', array('class' => 'btn btn-primary')) }}
            </td>
        </tr>
    </tbody>
</table>
</div>

<h1>Customers</h1>
Count ({{ $deals_count }}) - Selected (<span id="checkCount"></span>)
<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td><input type="checkbox" id="ckbCheckAll" /></td>
            <td>Name</td>
            <td>Year</td>
            <td>Make</td>
            <td>Model</td>
            <td>Miles</td>
            <td>Purchased</td>
            <td>Last Visit</td>
            <td>Last Called</td>
            <td>Agent</td>
            <td>Month</td>
        </tr>
    </thead>
    <tbody>
    @foreach($deals as $key => $value)
        <tr>
            <td>
            <input type="checkbox" class="checkBoxClass" 
            name="deal_id_{{ $value->id }}" value="{{ $value->id }}" 
            id="Checkbox{{ $value->id }}" onclick="countCheckboxes()"/>
            </td>
            <td><small>{{ $value->name }}</small></td>
            <td><small>{{ $value->vehicle_year }}</small></td>
            <td><small>{{ $value->vehicle_make }}</small></td>
            <td><small>{{ $value->vehicle_model }}</small></td>
            <td><small>{{ number_format($value->vehicle_mileage) }}</small></td>
            <td>
            <small>
            @if ($value->purchase_date)
                {{ date("m-d-Y",strtotime($value->purchase_date)) }}
            @endif
            </small>
            </td>
            <td><small>
            @if ($value->last_visit)
                {{ date("m-d-Y",strtotime($value->last_visit)) }}
            @endif </small>           
            </td>
            <td><small>
            @if ($value->last_called)
                {{ date("m-d-Y",strtotime($value->last_called)) }}
            @endif </small>
            </td>
            <td><small>
            @if ($value->agent_id)
                {{ $value->agent->name }}
            @endif </small>
            </td>
            <td><small>
            @if ($value->month_id)
                {{ $value->month->name }}
            @endif </small>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ Form::close() }}

@stop
