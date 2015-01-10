@extends("layout")
@section("content")

<h3>Calls in Disposition: {{ $disposition->name }}</h3>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered table-condensed table-hover">
    <thead>
        <tr>
            <td>Name</td>
            <td>Vehicle</td>
            <td>VIN</td>
            <td>Appointment</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($deals as $key => $value)
        <tr>
            <td><small>{{ $value->name }}</small></td>
            <td><small>{{ $value->vehicle_model }}</small></td>
            <td><small>{{ $value->vehicle_vin }}</small></td>
            <td><small>{{ $value->appointment }}</small></td>
    
            <td>
                {{ Form::open(array('url' => 'deals/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Deals', array('class' => 'btn btn-warning btn-xs')) }}
                {{ Form::close() }}
                <a class="btn btn-xs btn-success" href="{{ URL::to('deals/' . $value->id) }}">Show this Deals</a>
                <a class="btn btn-xs btn-info" href="{{ URL::to('deals/' . $value->id . '/edit') }}">Edit this Deals</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@stop
