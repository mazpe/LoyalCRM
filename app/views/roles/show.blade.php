@extends("layout")
@section("content")

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('roles') }}">Role</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('roles') }}">View All Roles</a></li>
        <li><a href="{{ URL::to('roles/create') }}">Create a Role</a>
    </ul>
</nav>

<h1>Showing {{ $role->name }}</h1>

    <div class="jumbotron text-left">
        <h2>{{ $role->name }}</h2>
    </div>

<h1>Add Permissions</h1>


{{ HTML::ul($errors->all()) }}
{{ Form::open(array('url' => 'roles/addpermission')) }}
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Permission</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <div class="form-group">
                {{ Form::label('permission_id', 'Permissions') }}
                {{ Form::select('permission_id', $permissions , null, array('class' => 'form-control')) }}
                </div>
            </td>
            <td>
                {{ Form::hidden('role_id', $role->id , null, null ) }}
                {{ Form::submit('Add Permission!', array('class' => 'btn btn-primary')) }}
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
    @foreach($permissionroles as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->permission->display_name }}</td>
            <td>
                <!-- 
                {{ Form::open(array('url' => 'roles/'. $role->id .'/deleterole/' . $value->id, 'class' => 'pull-right')) }}
                --> 
                {{ Form::open(array('url' => 'roles/deletepermission/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Permission', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>



@stop

