@extends("layout")
@section("content")


<table class="table">
<tbody>

    <tr>
        <td>
<strong>
<font color="red">
{{ HTML::ul($errors->all()) }}
</font>
</strong>
<h2>Edit Entry {{ $note->id }}</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'dealers/'.$dealer_id.'/note/'.$note->id.'/update')) }}
  
  <div class="form-group">
  {{ Form::label('last_contact_date', 'Last Contact Date') }}
  {{ Form::text('last_contact_date', $note->last_contact_date , null, array('class' => 'form-control')) }}
  </div>

  <div class="form-group">
  {{ Form::label('last_contact_type', 'Last Contact Type') }}
  {{ Form::select('last_contact_type',$contact_types,$note->last_contact_type_id , array('class' => 'form-control')) }}
  </div>

  <div class="form-group">
  {{ Form::label('last_contact_note', 'Last Contact Note') }}
  {{ Form::text('last_contact_note', $note->last_contact_note , null, array('class' => 'form-control')) }}
  </div>

  <div class="form-group">
  {{ Form::label('last_call', 'Last Call') }}
  {{ Form::checkbox('last_call', 'value', $note->last_call) }}
  </div>

  <div class="form-group">
  {{ Form::label('stage', 'Stage') }}
  {{ Form::select('stage',$stages,$note->stage_id , array('class' => 'form-control')) }}
  </div>




{{ Form::submit('Edit Note', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}


@stop
