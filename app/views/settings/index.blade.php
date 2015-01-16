@extends("layout")
@section("content")

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('settings') }}">Settings</a>
    </div>
</nav>

<h1>All the Settings</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<ul>
    <li><a href="{{ URL::to('users') }}">Users</a></li>
    <li><a href="{{ URL::to('roles') }}">Roles</a></li>
    <li><a href="{{ URL::to('permissions') }}">Permissions</a></li>
    <li><a href="{{ URL::to('dispositions') }}">Dispositions</a></li>
    <li><a href="{{ URL::to('manufactures') }}">Manufactures</a></li>
</ul>

@stop
