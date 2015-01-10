@extends("layout")
@section("content")

<h3>
<a href="{{ URL::to('agents/' . Auth::user()->id .'/dealer/'. $deal->dealer_id) }}"> {{ $deal->dealer->name }} </a> - Customer Call Record 
</h3>

<table class="table">
<tbody>
    <tr>
        <td>
            <table class="table table-striped table-bordered">
            <tbody>

                <tr>
                    <td width="20%">
                    <font color="red">
                        <strong>{{ strtoupper($deal->name) }}</strong>
                    </font>
                    </td>
                    <td width="10%">
                        <font color="blue">
                        <strong>{{ $deal->vehicle_year }}</strong>
                        </font>
                    </td>
                    <td width="12%"><strong>Last Disp</strong></td>
                    <td width="17%">
                    @if ($deal->disposition)
                        {{ $deal->disposition->name }}
                    @endif
                    </td>
                    <td width="18%" colspan="2">
@if ($disposition)
{{ date("m-d-Y  g:i A",strtotime($disposition->created_at)) }}
@endif
                    </td>
                    <td width="5%"><strong>Appt</strong></td>
                    <td width="18%">
                    @if ($deal->appointment)
                        {{ date("m-d-Y  g:i A",strtotime($deal->appointment)) }}
                    @endif
                    </td>
                </tr>
                <tr>
                    <td width="20%"><strong>City:</strong> {{ $deal->city }}</td>
                    <td width="10%">
                        <font color="blue">
                        <strong>{{ $deal->vehicle_make }}</strong>
                        </font>
                    </td>
                    <td width="12%"><strong>Delivery Date</strong></td>
                    <td width="15%">
                    @if ($deal->purchase_date)
                        {{ date("m-d-Y",strtotime($deal->purchase_date)) }}
                    @endif
                    </td>
                    <td width="8%"> {{ $purchase_date->diffInDays() }} </td>
                    <td width="10%"> Days since </td>
                    <td width="5%"><strong>Cell</strong></td>
                    <td width="18%">{{ $deal->phone }}</td>
                </tr>
                <tr>
                    <td width="20%"><strong>State:</strong> {{ $deal->state }}</td>
                    <td width="10%">
                        <font color="blue">
                        <strong>{{ $deal->vehicle_model }}</strong>
                        </font>
                    </td>
                    <td width="12%"><strong>Last Svc Date</strong></td>
                    <td width="15%">
                    @if ($deal->last_visit)
                        {{ date("m-d-Y",strtotime($deal->last_visit)) }}
                    @endif
                    </td>
                    <td width="8%">
                    @if ($deal->last_visit)
                        {{ $service_date->diffInDays() }}
                    @endif
                    </td>
                    <td width=="10%">Days since </td>
                    <td width="5%"><strong>Home</strong></td>
                    <td width="18%"></td>
                </tr> 
                <tr>
                    <td width="20%"><strong>VIN: </strong>{{ $deal->vehicle_vin }} </td>
                    <td width="10%"></td>
                    <td width="12%"><strong>Last Svc Miles</strong></td>
                    <td width="15%"> {{ $deal->vehicle_mileage }} </td>
                    <td width="8%">
@if ($deal->vehicle_mileage && $deal->last_visit)
    {{ (35 * $service_date->diffInDays()) + $deal->vehicle_mileage  }}
@else
    {{ (35 * $purchase_date->diffInDays())  }}
@endif
                    </td>
                    <td width="10%"> Miles now </td>
                    <td width="5%"><strong>Work</strong></td>
                    <td width="18%"> </td>
                </tr>

            </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>
{{ HTML::ul($errors->all()) }}
                        {{ Form::open(array('url' => 'deals/disposition')) }}
                        {{ Form::hidden('deal_id', $deal->id , null, array('class' => 'form-control')) }}
                        {{ Form::hidden('dealer_id', $deal->dealer_id , null, array('class' => 'form-control')) }}

            <table class="table table-striped table-bordered">
            <tbody>
                <tr>
                    <td>
                        {{ Form::label('disposition_id', 'Disposition') }}
                        {{ Form::select('disposition_id', $dispositions , null, array('class' => 'form-control')) }}

                    </td>
                    <td>
                        {{ Form::label('appointment', 'Appointment') }}
                        {{ Form::text('appointment', Input::old('appointment'), array('class' => 'form-control')) }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="form-group">
                        {{ Form::label('note', 'Note') }}
                        {{ Form::textarea('note', null,
                            array('class' => 'form-control',
                                  'size' => '30x1')) }}

                        {{ Form::label('email', 'Email on file (Enter Email below to send confirmation)') }}: {{ $deal->email }}
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
    <tr>
        <td>
            <h3>History</h3>
            <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td width="20%">Date</td>
                    <td width="25%">Disposition</td>
                    <td>Note</td>
                </tr>
            </thead>
            <tbody>
                @foreach($notes as $key => $value)
                <tr>
                   <td>{{ date("m-d-Y g:i A",strtotime($value->created_at)) }} </td>
                   <td>
                    @if ($value->disposition_id) 
                        {{ $value->disposition->name }}
                    @endif 
                    </td>
                   <td>{{ $value->note }} </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </td>
    </tr>
</tbody>
</table>


@stop

