@extends("layout")
@section("content")

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('dealergroups') }}">Dealer Group</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('dealergroups') }}">View All Dealer Groups</a></li>
        <li><a href="{{ URL::to('dealergroups/create') }}">Create a Dealer Group</a>
    </ul>
</nav>

<h1>Showing {{ $dealergroup->name }}</h1>

    <div class="jumbotron text-left">
        <h2>{{ $dealergroup->name }}</h2>
        <p>
            <strong>Address 1:</strong> {{ $dealergroup->address_1 }}<br>
            <strong>Address 2:</strong> {{ $dealergroup->address_2 }}<br>
            <strong>City:</strong> {{ $dealergroup->city }}<br>
            <strong>State:</strong> {{ $dealergroup->state }}<br>
            <strong>Zip:</strong> {{ $dealergroup->zip }}<br>
            <strong>Phone:</strong> {{ $dealergroup->phone }}<br>
            <strong>Fax:</strong> {{ $dealergroup->fax }}<br>
            <strong>Email:</strong> {{ $dealergroup->email }}<br>
        </p>

        <h2>Contact</h2>
        <p>
            <strong>Contact:</strong> {{ $dealergroup->contact }}<br>
            <strong>Phone:</strong> {{ $dealergroup->contact_phone }}<br>
            <strong>Email:</strong> {{ $dealergroup->contact_email }}<br>
        </p>
        <p>
            <strong>Added By:</strong> {{ $dealergroup->addedby->name }}<br>
            <strong>Active:</strong> {{ $dealergroup->active }}<br>
        </p>

    </div>


<h1>{{ $dealergroup->name }} Dealers</h1>

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
    @foreach($dealers as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->name }}</td>

            <td>
                {{ Form::open(array('url' => 'dealers/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this dealers', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}
                <a class="btn btn-small btn-success" href="{{ URL::to('dealers/' . $value->id . '/month/'. date('m')) }}">Show this dealers</a>

                <a class="btn btn-small btn-info" href="{{ URL::to('dealers/' . $value->id . '/edit') }}">Edit this dealers</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@stop
