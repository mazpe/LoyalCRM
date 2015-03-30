@extends("layout")
@section("content")

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('deals') }}">Customers</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('deals') }}">View All Customers</a></li>
    </ul>
</nav>

<h1>All the Customers</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Customerer</td>
            <td>Campaign</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($deals as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->dealer->name }}</td>
            <td>
            @if ($campaign = $value->campaign_id)
                {{ $value->campaign->name }}
            @endif
            </td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>
                <!-- delete the deals (uses the destroy method DESTROY /deals/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'deals/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Customers', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}
                <!-- show the deals (uses the show method found at GET /deals/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('deals/' . $value->id) }}">Show this Customers</a>

                <!-- edit this deals (uses the edit method found at GET /deals/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('deals/' . $value->id . '/edit') }}">Edit this Customers</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>


@stop
