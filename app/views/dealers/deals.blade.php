@extends("layout")
@section("content")
<?php
$i = 1;
?>

@if (Auth::user()->hasRole('Admin'))
<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('deals') }}">Deals</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('deals') }}">View All Deals</a></li>
        <li><a href="{{ URL::to('deals/create') }}">Create a Deals</a>
    </ul>
</nav>
@endif
<h3>
<a href="{{ URL::to('dealers/'.$dealer->id.'/month/'. date('m') ) }}">{{ $dealer->name }} </a> - 

@if($disposition_id == "total")
    Total Calls
@elseif($disposition_id == "assigned")
    Assigned Now
@else
    @if (isset($disposition))
        Calls in Disposition: {{ $disposition->name }}
    @endif
@endif
</h3>
Count ({{ $deals_count }})

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered table-condensed table-hover">
    <thead>
        <tr>
            <th><strong>ID</strong></th>
            <th><strong>Name</strong></th>
            <th><strong>Make</strong></th>
            <th><strong>Model</strong></th>
@if ($disposition)
    @if (preg_match("/^Appointment - Set/",$disposition->name) )
        <th width="14%"><strong>Appointment</strong></th>
    @endif
    @if (preg_match("/^Appointment/",$disposition->name) 
        || preg_match("/^Call/",$disposition->name))
        <th width="14%"><strong>Called</strong></th>
    @endif
@endif
@if ($disposition_id == "assigned" || $disposition_id == "total")
            <th width="14%"><strong>Last Called</strong></th>
@endif
            <th width="15%"><strong>Disposition</strong></th>
            <th><strong>Last Note</strong></th>
@if (Auth::user()->hasRole('Admin1'))
            <th><strong>Actions</strong></th>
@endif
        </tr>
    </thead>
    <tbody>
    @foreach($deals as $key => $value)
        <tr>
            <td><small>{{ $i++ }}</small></td>
            <td>
            <small>
            <a href="{{ URL::to('deals/'. $value->id) }}">
            {{ $value->name }}
            </a>
            </small>
            </td>
            <td><small>{{ $value->vehicle_make }}</small></td>
            <td><small>{{ $value->vehicle_model }}</small></td>
@if ($disposition)
    @if (preg_match("/^Appointment - Set/",$disposition->name))
            <td>
            <small>
            @if ($value->appointment)
                {{ date("m-d-Y  g:i A",strtotime($value->appointment)) }}
            @endif
            </small>
            </td>
    @endif
    @if (preg_match("/^Appointment/",$disposition->name)
        || preg_match("/^Call/",$disposition->name) )
            <td>
            <small>
            @if ($value->created_at)
                {{ date("m-d-Y  g:i A",strtotime($value->created_at)) }}
            @endif
            </small>
            </td>
    @endif
@endif
    @if ($disposition_id == "assigned" || $disposition_id == "total")
            <td>
            <small>
            @if ($value->last_called)
                {{ date("m-d-Y  g:i A",strtotime($value->last_called)) }}
            @endif
            </small>
            </td>
    @endif
            <td>
                <small> {{ $value->disposition_name }} </small>
            </td>
            <td>
                <small> {{ $value->last_note }} </small>
            </td>

@if (Auth::user()->hasRole('Admin1'))
            <td width="30%">
                {{ Form::open(array('url' => 'deals/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Customer', array('class' => 'btn btn-warning btn-xs')) }}
                {{ Form::close() }}
                <a class="btn btn-xs btn-info" href="{{ URL::to('deals/' . $value->id . '/edit') }}">Edit this Customer</a>
            </td>
@endif
        </tr>
    @endforeach
    </tbody>
</table>

@stop
