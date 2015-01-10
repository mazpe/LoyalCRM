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
<a href="{{ URL::to('dealers/'.$dealer->id.'/month/'. date('m') ) }}">{{ $dealer->name }} </a>
- Edit a Month
</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'dealers/'.$dealer->id.'/month/'.$month->month_id.'/edit_month_store')) }}
{{ Form::hidden('dealersmonth_id', $month->id) }}

    <div class="form-group">
        {{ Form::label('month_id', 'Months') }}
        {{ Form::select('month_id', $months , $month->month_id, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('records', 'Records') }}
        {{ Form::text('records', $month->records, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('rate', 'Rate') }}
        {{ Form::text('rate', $month->rate, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('note', 'Note') }}
        {{ Form::textarea('note', $month->note, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('active', 'Active') }}
        {{ Form::select('active', array('1' => 'Active', '2' => 'Inactive'), Input::old('active'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Edit Month!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop
