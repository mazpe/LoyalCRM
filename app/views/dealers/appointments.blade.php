@extends("layout")
@section("content")
<?php
$i = 1;
?>


@if (Auth::user()->hasRole('Admin1'))
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
<a href="{{ URL::to('dealers/'.$dealer->id.'/month/'. $month ) }}">{{ $dealer->name }} </a>
- Appointments
</h3>

Count ({{ $appointments_count }})

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered table-condensed table-hover">
    <thead>
        <tr>
            <th width="3%"><strong>ID</strong></th>
            <th width="20%"><strong>Name</strong></th>
            <th><strong>Vehicle</strong></th>
            <th width="15%"><strong>Appointment</strong></th>
            <th width="15%"><strong>Created</strong></th>
            <th><strong>Note</strong></th>
@if (Auth::user()->hasRole('Admin1'))
            <th><strong>Actions</strong></th>
@endif
        </tr>
    </thead>
    <tbody>
    @foreach($appointments_rst as $key => $value)
        <tr>
            <td><small>{{ $i++ }}</small></td>
            <td>
            <small>
            <a href="{{ URL::to('deals/'. $value->id) }}">
            {{ $value->name }}
            </a>
            </small>
            </td>
            <td><small>{{ $value->vehicle_model }}</small></td>
            <td>
            <small>
            @if ($value->appointment)
                {{ date("m-d-Y  g:i A",strtotime($value->appointment)) }}
            @endif
            </small>
            </td>
            <td>
            <small>
            @if ($value->appointment)
                {{ date("m-d-Y  g:i A",strtotime($value->created_at)) }}
            @endif
            </small>
            </td>
            <td>
            <small>
            {{ $value->note }}
            </small>
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
