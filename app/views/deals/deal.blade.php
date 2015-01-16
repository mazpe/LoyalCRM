@extends("layout")
@section("content")
<h3>
<strong>
<a href="{{ URL::to('dealers/'.$deal->dealer_id.'/month/'. date('m') ) }}">{{ $deal->dealer->name }} </a>
<strong>
@if (Auth::user()->hasRole('Agent'))
<small>
- <strong>Service Phone:</strong> 
@if ($deal->dealer->service_phone)
    {{ $deal->dealer->service_phone }} 
@else
    N/A
@endif
- <strong>Hours:</strong>
@if ($deal->dealer->hours_of_operation)
    {{ $deal->dealer->hours_of_operation }}
@else 
    N/A
@endif
</small>
@endif
</h3>

<font size="2">
<table class="table">
<tbody>
    <tr>
        <td>
            <table class="table table-striped table-bordered">
            <tbody>

                <tr>
                    <td width="20%">
                    <small> 
                    <font color="red">
                        <strong>{{ strtoupper($deal->name) }}</strong>
                    </font>
                    </small>
                    </td>
                    <td width="10%">
                    <small> 
                        <font color="blue">
                        <strong>{{ $deal->vehicle_year }}</strong>
                        </font>
                    </small> 
                    </td>
                    <td width="12%">
                    <small><strong>Last Disp</strong></small>
                    </td>
                    <td width="17%">
                    <small>
                    @if ($deal->disposition)
                        {{ $deal->disposition->name }}
                    @endif
                    </small>
                    </td>
                    <td width="18%" colspan="2">
                    <small>
@if ($disposition)
{{ date("m-d-Y  g:i A",strtotime($disposition->created_at)) }}
@endif
                    </small>
                    </td>
                    <td width="5%"><small><strong>Appt</strong></small></td>
                    <td width="18%">
                    <small>
                    @if ($deal->appointment)
                        {{ date("m-d-Y  g:i A",strtotime($deal->appointment)) }}
                    @endif
                    </small>
                    </td>
                </tr>
                <tr>
                    <td width="20%">
                    <small><strong>City:</strong> {{ $deal->city }}</small>
                    </td>
                    <td width="10%">
                    <small>
                        <font color="blue" size="2">
                        <strong>{{ $deal->vehicle_make }}</strong>
                        </font>
                    </small>
                    </td>
                    <td width="12%">
                    <small><strong>Delivery Date</strong></small>
                    </td>
                    <td width="15%">
                    <small>
                    @if ($deal->purchase_date)
                        {{ date("m-d-Y",strtotime($deal->purchase_date)) }}
                    @endif
                    </small>
                    </td>
                    <td width="8%">
                    @if ($deal->purchase_date)
                    <small> {{ $purchase_date->diffInDays() }} </small>
                    @endif
                    </td>
                    <td width="10%"> <small>Days since </small></td>
                    <td width="5%"><small><strong>Cell</strong></small></td>
                    <td width="18%"><small>{{ $deal->phone }}</small></td>
                </tr>
                <tr>
                    <td width="20%">
                    <small><strong>State:</strong> {{ $deal->state }}</small>
                    </td>
                    <td width="10%">
                    <small>
                        <font color="blue" size="2">
                        <strong>{{ $deal->vehicle_model }}</strong>
                        </font>
                    </small>
                    </td>
                    <td width="12%">
                    <small><strong>Last Svc Date</strong></small>
                    </td>
                    <td width="15%">
                    <small>
                    @if ($deal->last_visit)
                        {{ date("m-d-Y",strtotime($deal->last_visit)) }}
                    @endif
                    </small>
                    </td>
                    <td width="8%">
                    <small>
                    @if ($deal->last_visit)
                        {{ $service_date->diffInDays() }}
                    @endif
                    </small>
                    </td>
                    <td width=="10%"><small>Days since</small> </td>
                    <td width="5%"><small><strong>Home</strong></small></td>
                    <td width="18%"><small>{{ $deal->phone_home }}</small></td>
                </tr> 
                <tr>
                    <td width="20%">
                    <small>
                    <strong>VIN: </strong>{{ $deal->vehicle_vin }}
                    </small>
                    </td>
                    <td width="10%"></td>
                    <td width="12%">
                    <small><strong>Last Svc Miles</strong></small>
                    </td>
                    <td width="15%">
                    <small> {{ $deal->vehicle_mileage }}</small> 
                    </td>
                    <td width="8%">
                    <small>
@if ($deal->vehicle_mileage && $deal->last_visit)
    {{ (35 * $service_date->diffInDays()) + $deal->vehicle_mileage  }}
@else
    {{ (35 * $purchase_date->diffInDays())  }}
@endif
                    </small>
                    </td>
                    <td width="10%"><small> Miles now</small> </td>
                    <td width="5%"><small><strong>Work</strong></small></td>
                    <td width="18%"><small>{{ $deal->phone_work }} <small></td>
                </tr>

            </tbody>
            </table>
        </td>
    </tr>


@if (Auth::user()->hasRole('Agent') || Auth::user()->hasRole('Admin'))


    <tr>
        <td>
<strong>
<font color="red">
{{ HTML::ul($errors->all()) }}
</font>
</strong>
                        {{ Form::open(array('url' => 'deals/disposition')) }}
                        {{ Form::hidden('deal_id', $deal->id , null, array('class' => 'form-control')) }}
                        {{ Form::hidden('dealer_id', $deal->dealer_id , null, array('class' => 'form-control')) }}

            <table class="table table-striped table-bordered table-condensed">
            <tbody>
                <tr>
                    <td>
                        {{ Form::label('disposition_id', 'Disposition', array('class' => 'small')) }}
                        {{ Form::select('disposition_id', $dispositions , null, array('class' => 'form-control')) }}

                    </td>
                    <td>
                        {{ Form::label('last_id', 'Last Call',  array('class' => 'small')) }}<br />
                        {{ Form::checkbox('last_call','yes') }}

                    </td>

                    <td>
                        {{ Form::label('appointment', 'Appointment',  array('class' => 'small')) }}
                        {{ Form::text('appointment', Input::old('appointment'), array('class' => 'form-control')) }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="form-group">
                        {{ Form::label('note', 'Note', array('class' => 'small')) }}
                        {{ Form::textarea('note', null,
                            array('class' => 'form-control',
                                  'size' => '30x1')) }}

                        {{ Form::label('email', 'Email on file (Enter Email below to send confirmation)',  array('class' => 'small')) }}: {{ $deal->email }}
                        {{ Form::text('confirmation_email', null , array('class' => 'form-control')) }}

                        </div>
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


@endif



    <tr>
        <td>
            <h3>History</h3>
            <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th width="20%">Date</th>
                    <th width="25%">Disposition</th>
                    <th>Note</th>
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
                    @if ($value->disposition_id) 
                        {{ $value->disposition->name }}
                    @endif 
                    </small>
                    </td>
                   <td><small>{{ $value->note }}</small></td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </td>
    </tr>
</tbody>
</table>


@stop

