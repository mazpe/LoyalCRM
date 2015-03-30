@extends("layout")
@section("content")

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('permissions') }}">Permissions</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('permissions') }}">View All Permissions</a></li>
        <li><a href="{{ URL::to('permissions/create') }}">Create a Permissions</a>
    </ul>
</nav>

<h1>All the Permissions</h1>

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
    @foreach($permissions as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->dealer->name }}</td>
            <td>
                {{ Form::open(array('url' => 'permissions/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Permissions', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}
                <a class="btn btn-small btn-success" href="{{ URL::to('permissions/' . $value->id) }}">Show this Permissions</a>
                <a class="btn btn-small btn-info" href="{{ URL::to('permissions/' . $value->id . '/edit') }}">Edit this Permissions</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>


@stop
