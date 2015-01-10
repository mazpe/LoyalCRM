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

<h1>All the Manufactures</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($manufactures as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->name }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the manufacture (uses the destroy method DESTROY /manufactures/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'manufactures/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Manufacture', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}
                <!-- show the manufacture (uses the show method found at GET /manufactures/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('manufactures/' . $value->id) }}">Show this Manufacture</a>

                <!-- edit this manufacture (uses the edit method found at GET /manufactures/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('manufactures/' . $value->id . '/edit') }}">Edit this Manufacture</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@stop
