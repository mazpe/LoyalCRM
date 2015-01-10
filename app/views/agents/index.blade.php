@extends("layout")
@section("content")

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('agents') }}">Agents</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('agents') }}">View All Agents</a></li>
        <li><a href="{{ URL::to('agents/create') }}">Create a Agents</a>
    </ul>
</nav>

<h1>All the Agents</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Name</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($agents as $key => $value)
        <tr>
            <td>{{ $value->name }}</td>

            <td>
                {{ Form::open(array('url' => 'agents/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Agents', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}
                <a class="btn btn-small btn-success" href="{{ URL::to('agents/' . $value->id) }}">Show this Agents</a>
                <a class="btn btn-small btn-info" href="{{ URL::to('agents/' . $value->id . '/edit') }}">Edit this Agents</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>


@stop
