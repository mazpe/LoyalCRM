@extends("layout")
@section("content")

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('appointments') }}">Appointments</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('appointments') }}">View All Appointments</a></li>
        <li><a href="{{ URL::to('appointments/create') }}">Create a Appointments</a>
    </ul>
</nav>

<h1>All the Appointments</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Dealer</td>
            <td>Appointment</td>
            <td>Contact</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($appointments as $key => $value)
        <tr>
            <td>{{ $value->deal->dealer->name }}</td>
            <td>{{ date("m-d-Y",strtotime($value->appointment)) }}</td>
            <td>{{ $value->deal->name }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the appointments (uses the destroy method DESTROY /appointments/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'appointments/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Appointments', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}
                <!-- show the appointments (uses the show method found at GET /appointments/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('appointments/' . $value->id) }}">Show this Appointments</a>

                <!-- edit this appointments (uses the edit method found at GET /appointments/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('appointments/' . $value->id . '/edit') }}">Edit this Appointments</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>


@stop
