@extends("layout")
@section("content")

<?php
    if ($dealer->next_contact_date) {
        $next_contact_date 
            = date("m-d-Y  g:i A",strtotime($dealer->next_contact_date));
        $next_contact_date = $dealer->next_contact_date;
    } else {
        $next_contact_date = "";
    }
?>

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('dealers/'. $dealer->id) }}">
        <font color="orange">
            {{ strtoupper($dealer->name) }}
        </font>
        </a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('dealers/'. $dealer->id .'/edit') }}"> Edit</a>
        <li><a href="{{ URL::to('dealers/'. $dealer->id .'/delete') }}">Delete</a>
    </ul>
</nav>

<table class="table">
<tbody>
    <tr>
        <td>
            <table class="table table-striped table-bordered table-condensed">
            <tbody>

                <tr>
                    <td width="20%" colspan="2">
<a href="https://www.google.com/maps/place/{{ str_replace(' ', '+',$dealer->address_1) }},{{ str_replace(' ', '+',$dealer->city) }},{{ $dealer->state }}+{{ $dealer->zip }}" target="_blank">
                    <small> {{ $dealer->address_1 }} </small>
</a>
                    </td>
                    <td width="12%"> <small><strong>OEM</strong></small> </td>
                    <td width="15%"> 
                    @if ($dealer->manufacture)
                        <small> {{ $dealer->manufacture->name }} </small>
                    @endif
                    </td>
                    <td width="5%"> <small><strong>Main</strong></small></td>
                    <td width="15%"> <small>{{ $dealer->phone }}</small> </td>
                    <td width="22%">
                        <strong>
                        <small>Primary Contact / Email Address</small>
                        </strong>
                    </td>
                </tr>
                <tr>
                    <td width="5%"> <small><strong>City:</strong></small> </td>
                    <td> <small> {{ $dealer->city }} </small> </td>
                    <td> <small><strong>Owner</strong></small> </td>
                    <td> <small> {{ $dealer->owner }} </small> </td>
                    <td> <small><strong>Direct</strong></small></td>
                    <td> <small>{{ $dealer->owner_phone }} </small></td>
                    <td>
                        <small>{{ $dealer->owner_email }}</small>
                    </td>
                </tr>
                <tr>
                    <td><small><strong>State:</strong></small> </td>
                    <td> <small> {{ $dealer->state }} </small> </td>
                    <td>
                    <small><strong>General Manager</strong></small>
                    </td>
                    <td>
                    <small>
                        {{ $dealer->general_manager }}
                    </small>
                    </td>
                    <td> <small><strong>Direct</strong></small></td>
                    <td> 
                        <small>{{ $dealer->general_manager_phone }} </small>
                    </td>
                    <td>
                        <small>{{ $dealer->general_manager_email }}</small>
                    </td>
                </tr> 
                <tr>
                    <td colspan="2">
                        <a href="http://{{ $dealer->website  }}" 
                            target="_blank">
                        {{ $dealer->website }}
                        </a>
                     </td>
                    <td>
                    <small><strong>Sales Manager</strong></small>
                    </td>
                    <td>
                    <small> {{ $dealer->sales_manager }}</small> 
                    </td>
                    <td> <small><strong>Direct</strong></small></td>
                    <td> 
                        <small>{{ $dealer->sales_manager_phone }} </small>
                    </td>
                    <td> 
                        <small>{{ $dealer->sales_manager_email }}</small>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                    @if ($dealer->dealergroup)
                        {{ $dealer->dealergroup->name }}
                    @endif
                    </td>
                    <td>
                    <small><strong>Service Manager</strong></small>
                    </td>
                    <td>
                    <small> {{ $dealer->service_manager }}</small>
                    </td>
                    <td> <small><strong>Direct</strong></small></td>
                    <td>
                        <small>{{ $dealer->service_manager_phone }} </small>
                    </td>
                    <td>
                        <small>{{ $dealer->service_manager_email }}</small>
                    </td>
                </tr>
                <tr>
                    <td colspan="7">
                        {{ $dealer->note }}
                    </td>
                </tr>


            </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>
<strong>
<font color="red">
{{ HTML::ul($errors->all()) }}
</font>
</strong>
                        {{ Form::open(array('url' => 'dealers/disposition')) }}
                        {{ Form::hidden('dealer_id', $dealer->id , null, array('class' => 'form-control')) }}

            <table class="table table-striped table-bordered table-condensed">
            <tbody>
                <tr>
                    <td>
                        {{ Form::label('last_contact_date', 'Last Contact Date',  array('class' => 'small')) }}
                        {{ Form::text('last_contact_date', $dealer->last_contact_date, array('class' => 'form-control')) }}
                    </td>

                    <td>
                        {{ Form::label('last_contact_type', 'Last Contact Type', array('class' => 'small')) }}
                        {{ Form::select('last_contact_type_id', $contact_types , $dealer->last_contact_type_id, array('class' => 'form-control')) }}

                    </td>

                    <td align="center">
                        {{ Form::label('last_call', 'Last Call',  array('class' => 'small')) }}<br />
                        {{ Form::checkbox('last_call','yes',$dealer->last_call, array('id' => 'last_call_cb')) }}

<small> <div id='next_to_last'>(<a href="#">copy  next to last</a>)</div> </small>
                    </td>

                    <td>
                        {{ Form::label('next_contact_date', 'Next Contact Date',  array('class' => 'small')) }}
                        {{ Form::text('next_contact_date', $next_contact_date, array('class' => 'form-control')) }}
                    </td>

                    <td>
                        {{ Form::label('next_contact_type', 'Next Contact Type', array('class' => 'small')) }}
                        {{ Form::select('next_contact_type_id', $contact_types , $dealer->next_contact_type_id, array('class' => 'form-control')) }}

                    </td>

                </tr>
                <tr>
                    <td colspan="2">
                        {{ Form::label('last_contact_note', 'Last Contact Note',
                             array('class' => 'small')) }}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <small>Update History</small> 
                        {{ Form::checkbox('update_history','yes','yes' ) }}

                        {{ Form::textarea('last_contact_note', 
                            $dealer->last_contact_note,
                            array('class' => 'form-control',
                                  'size' => '30x5', 
                                  'id' => 'last_contact_note')) }}
                    </td>
                    <td align="center">
                        {{ Form::label('stage_id', 'Stage', array('class' => 'small')) }}
                        {{ Form::select('stage_id', $stages , $dealer->stage_id,  array('class' => 'form-control')) }}

                    </td>
                    <td colspan="2">
                        {{ Form::label('next_contact_note', 'Next Contact Note', array('class' => 'small')) }}
                        {{ Form::textarea('next_contact_note', $dealer->next_contact_note,
                            array('class' => 'form-control',
                                  'size' => '30x5', 
                                  'id' => 'next_contact_note')) }}
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <div class="form-group">
                        {{ Form::submit('Save and Stay', array('class' => 'btn btn-primary','name' => 'SaveAndStay')) }}
                        {{ Form::submit('Save and Close', array('class' => 'btn btn-primary','name' => 'SaveAndClose')) }}
                        </div>
                        {{ Form::close() }}
                    </td>
                </tr>
            </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <h3>History</h3>
            <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th width="14%">Entry Date</th>
                    <th width="14%">Contact Date</th>
                    <th width="12%">Contact Type</th>
                    <th>Contact Note</th>
                    <th width="10%">Stage</th>
                    <th width="8%">Last Call</th>
                    <th width="8%">AB</th>
                </tr>
            </thead>
            <tbody>
                @foreach($notes as $key => $value)
                <tr>
                   <td>
                    <small>
                    {{ date("m-d-Y g:i A",strtotime($value->created_at)) }}
                    </small>
                    </td>

                   <td>
                    <small>
@if ($value->last_contact_date)
    {{ date("m-d-Y g:i A",strtotime($value->last_contact_date)) }}
@endif
                    </small>
                    </td>
                   <td>
@if ($value->contacttype) 
 <small> {{ $value->contacttype->name }} </small> 
@endif
                    </td>
                   <td><small>{{ $value->last_contact_note }}</small></td>
                   <td><small>{{ $value->stage->name }}</small></td>
                   
                   <td>
                    <small>
@if ($value->last_call == "1")
    Yes
@endif  
                    </small>
                    </td>
                   <td>
                    <small>
@if ($value->added_by_id)
    {{ $value->addedby->initials }}
@endif  
                 </small>
                 </td>   
                </tr>
                @endforeach
            </tbody>
            </table>
        <td>
    </tr>
</tbody>
</table>


@stop

