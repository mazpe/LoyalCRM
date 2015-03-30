@extends("layout")
@section("content")

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('dealers') }}">Dealer</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('dealers/create') }}">Create a r</a>
        <li><a href="{{ URL::to('dealers/create') }}">Assignment</a>
    </ul>
</nav>

<h1>
<a href="{{ URL::to('dealers/'.$dealer_id.'/month/'. date('m') ) }}">{{ $dealer_name }} </a>
- Create a Month
</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'dealers/'.$dealer_id.'/create_month_store')) }}
{{ Form::hidden('dealer_id', $dealer_id) }}

    <div class="form-group">
        {{ Form::label('month_id', 'Months') }}
        {{ Form::select('month_id', $months , Input::old('month_id'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('records', 'Records') }}
        {{ Form::text('records', $records, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('rate', 'Rate') }}
        {{ Form::text('rate', $rate, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('note', 'Note') }}
        {{ Form::textarea('note', Input::old('note'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('active', 'Active') }}
        {{ Form::select('active', array('1' => 'Active', '2' => 'Inactive'), Input::old('active'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Create the Dealer!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop
