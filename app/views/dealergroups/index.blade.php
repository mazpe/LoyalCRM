@extends("layout")
@section("content")

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('dealergroups') }}">Dealer Groups</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('dealergroups') }}">View All Dealer Groupss</a></li>
        <li><a href="{{ URL::to('dealergroups/create') }}">Create a Dealer Groups</a>
    </ul>
</nav>

<h1>All the Dealer Groups</h1>
Count({{ $dealergroups->count() }})

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Name</td>
            <td>City</td>
            <td>State</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($dealergroups as $key => $value)
        <tr>
            <td>{{ $value->name }}</td>
            <td>{{ $value->city }}</td>
            <td>{{ $value->state }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the dealergroups (uses the destroy method DESTROY /dealergroups/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'dealergroups/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Dealer Groups', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}
                <!-- show the dealergroups (uses the show method found at GET /dealergroups/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('dealergroups/' . $value->id) }}">Show this Dealer Groups</a>

                <!-- edit this dealergroups (uses the edit method found at GET /dealergroups/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('dealergroups/' . $value->id . '/edit') }}">Edit this Dealer Groups</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@stop
