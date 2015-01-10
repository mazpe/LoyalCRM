@extends("layout")
@section("content")

<h2>{{ $dealer->name }} - Customers Call List</h2>
Count ({{ $deals_count }}) &nbsp;&nbsp;&nbsp;&nbsp;
<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<h2>Criterias</h2>
<button class="hidetext">Hide/Show</button>

<div class="criteria" style="display:none">
<br />

{{ Form::open(array('url' => 'agents/dealer/search')) }}
{{ Form::hidden('dealer_id', $dealer->id , null) }}
<table class="table table-striped table-bordered table-condensed">
    <tbody>
        <tr>
            <td>
    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name') ) }}
    </div>
    <div class="form-group">
        {{ Form::label('phone', 'Phone') }}
        {{ Form::text('phone', Input::old('phone') ) }}
    </div>
    <div class="form-group">
        {{ Form::label('lastcalled_from', 'Last Called:') }}
        {{ Form::text('lastcalled_from', Input::old('lastcalled_from'), array('id' => 'lastcalled_from') ) }}
        {{ Form::text('lastcalled_to', Input::old('lastcalled_to'), array('id' => 'lastcalled_to')) }}
    </div>
    <div class="form-group">
        {{ Form::label('last_disposition', 'Last Disposition') }}
        {{ Form::select('last_disposition', $dispositions , Input::old('last_disposition'), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('sort', 'Sort:') }}
        {{ Form::select('sort', array ('deals.name' => 'Name','last_called' => 'Last Called', 'disposition_id' => 'Last Disposition') , Input::old('sort')) }}
    </div>
    <div class="form-group">
        {{ Form::label('sort_direction', 'Direction:') }}
        {{ Form::select('sort_direction', array ('ASC' => 'ASC', 'DESC' => 'DESC') , Input::old('sort_direction')) }}
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
<br>
<br>


<?php
 $i = 1;
?>

<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th width="3%">#</th>
            <th width="25%">Name</th>
            <th width="13%">Last Called</th>
            <th width="8%">Last Disp</th>
            <th width="15%">Next Cont Date</th>
            <th width="12%">Next Cont Type</th>
            <th>Last Note</th>
        </tr>
    </thead>
    <tbody>
    @foreach($deals as $key => $value)
        <tr>
            <td><small>{{ $i++ }}</small></td>
            <td>
<a href="{{ URL::to('agents/'.$agent_id .'/dealer/'. $dealer->id.'/deal/' . $value->id) }}">
<small>{{ $value->name }}</small>
</a>
            </td>
            <td><small>
            @if ($value->last_called)
                {{ date("m-d-Y  g:i A",strtotime($value->last_called)) }}
            @endif
            </small>
            </td>
            <td><small>
            @if ($value->disposition_id)
                {{ $value->disposition_name }}
            @endif
            </small>
            </td>
            <td><small>
            @if ($value->next_contact_date)
                {{ date("m-d-Y  g:i A",strtotime($value->next_contact_date)) }}
            @endif
            </small>
            </td>
            <td> <small>{{ $value->next_contact_type }} </small></td>
            <td> <small>{{ $value->last_note }} </small></td>
        </tr>
    @endforeach
    </tbody>
</table>

@stop
