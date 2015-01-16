@extends("layout")
@section("content")

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('users') }}">View All Users</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('users/'.$user->id.'/edit') }}">Edit</a></li>
    </ul>
</nav>

<h1>Showing {{ $user->name }}</h1>
    <div class="jumbotron text-left">
        <h2>{{ $user->name }}</h2>
        <p>
            <strong>Username:</strong> {{ $user->username }}<br>
            <strong>Address 1:</strong> {{ $user->address_1 }}<br>
            <strong>Address 2:</strong> {{ $user->address_2 }}<br>
            <strong>City:</strong> {{ $user->city }}<br>
            <strong>Email:</strong> {{ $user->email }}<br>
        </p>
    </div>

<h1>Add Roles</h1>

{{ HTML::ul($errors->all()) }}
{{ Form::open(array('url' => 'users/addrole')) }}
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Campaign</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <div class="form-group">
                {{ Form::label('role_id', 'Roles') }}
                {{ Form::select('role_id', $roles , null, array('class' => 'form-control')) }}
                </div>
            </td>
            <td>
                {{ Form::hidden('user_id', $user->id , null, null ) }}
                {{ Form::submit('Add Role!', array('class' => 'btn btn-primary')) }}
            </td>
        </tr>
    </tbody>
</table>
{{ Form::close() }}

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($assignedroles as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->role->name }}</td>
            <td>
                <!-- 
                {{ Form::open(array('url' => 'users/'. $user->id .'/deleterole/' . $value->id, 'class' => 'pull-right')) }}
                --> 
                {{ Form::open(array('url' => 'users/deleterole/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Role', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@stop

