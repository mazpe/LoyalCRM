@extends("layout")
@section("content")

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('roles') }}">Roles</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('roles') }}">View All Roles</a></li>
        <li><a href="{{ URL::to('roles/create') }}">Create a Roles</a>
    </ul>
</nav>

<h1>All the Roles</h1>

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
    @foreach($roles as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->name }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the roles (uses the destroy method DESTROY /roles/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'roles/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Roles', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}
                <!-- show the roles (uses the show method found at GET /roles/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('roles/' . $value->id) }}">Show this Roles</a>

                <!-- edit this roles (uses the edit method found at GET /roles/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('roles/' . $value->id . '/edit') }}">Edit this Roles</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>


@stop
