@extends("layout")
@section("content")

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('manufactures') }}">Manufacture</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('manufactures') }}">View All Manufactures</a></li>
        <li><a href="{{ URL::to('manufactures/create') }}">Create a Manufacture</a>
    </ul>
</nav>

<h1>Showing {{ $manufacture->name }} Manufacture</h1>

    <div class="jumbotron text-left">
        <h2>{{ $manufacture->name }}</h2>
        <p>
            <strong>Addded By:</strong> {{ $manufacture->addedby->name }}
        </p>
    </div>

<h2>{{ $manufacture->name }} Dealers</h2>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($dealers as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->name }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the dealer (uses the destroy method DESTROY /dealers/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'dealers/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Dealer', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}
                <!-- show the dealer (uses the show method found at GET /dealers/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('dealers/' . $value->id) }}">Show this Dealer</a>

                <!-- edit this dealer (uses the edit method found at GET /dealers/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('dealers/' . $value->id . '/edit') }}">Edit this Dealer</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@stop
