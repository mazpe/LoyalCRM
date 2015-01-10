@extends("layout")
@section("content")

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('campaigns') }}">Campaigns</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('campaigns') }}">View All Campaigns</a></li>
        <li><a href="{{ URL::to('campaigns/create') }}">Create a Campaigns</a>
    </ul>
</nav>

<h1>All the Campaigns</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Dealer</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($campaigns as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->dealer->name }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the campaigns (uses the destroy method DESTROY /campaigns/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'campaigns/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Campaigns', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}
                <!-- show the campaigns (uses the show method found at GET /campaigns/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('campaigns/' . $value->id) }}">Show this Campaigns</a>

                <!-- edit this campaigns (uses the edit method found at GET /campaigns/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('campaigns/' . $value->id . '/edit') }}">Edit this Campaigns</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>


@stop
