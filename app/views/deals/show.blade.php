@extends("layout")
@section("content")

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('deals') }}">Customer</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('deals') }}">View All Customers</a></li>
    </ul>
</nav>

@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<strong><a href="{{ URL::to('dealers/'. $deal->dealer_id.'/month/'.date('m')) }}">{{ $deal->dealer->name }}</a></strong>
<table class="table">
<tbody>
    <tr>
        <td>
            <table class="table table-striped table-bordered">
            <tbody>
                <tr>
                    <td width="25%"><font color="red"><strong>{{ $deal->name }}</strong></font></td>    
                    <td width="10%">{{ $deal->vehicle_year }}</td>            
                    <td width="20%"><strong>Delivery Date</strong></td>         
                    <td width="20%">{{ date("m-d-Y",strtotime($deal->purchase_date)) }}</td>            
                    <td width="10%"><strong>Home</strong></td>
                    <td width="15%">{{ $deal->phone }}</td>
                </tr>
                <tr>
                    <td width="25%">{{ $deal->city }}</td>
                    <td width="10%">{{ $deal->vehicle_make }}</td>
                    <td width="20%"><strong>Last Service Date</strong></td>
                    <td width="20%">{{ $deal->last_visit }}</td>
                    <td width="10%"><strong>Cell</strong></td>
                    <td width="15%"></td>
                </tr>
                <tr>
                    <td width="25%">{{ $deal->state }}</td>
                    <td width="10%">{{ $deal->vehicle_model }}</td>
                    <td width="20%"><strong>Last Service Mileage</strong></td>
                    <td width="20%">{{ $deal->vehicle_mileage }}</td>
                    <td width="10%"><strong>Work</strong></td>
                    <td width="15%"></td>
                </tr>
                <tr>
                    <td width="25%">{{ $deal->vehicle_vin }} </td>
                    <td width="10%"></td>
                    <td width="20%"><strong>Last Disposition</strong></td>
                    <td width="20%">
@if ($deal->disposition_id)
{{ $deal->disposition->name }}
@endif
                    </td>
                    <td width="10%"><strong>Appointment</strong></td>
                    <td width="15%">{{ date("m-d-Y",strtotime($deal->appointment)) }}</td>
                </tr>
                <tr>
                    <td width="25%"></td>
                    <td width="10%"></td>
                    <td width="20%"><strong>Service Due</strong></td>
                    <td width="20%"></td>
                    <td width="10%"></td>
                    <td width="15%"></td>
                </tr>
                <tr>
                    <td width="25%"><strong>Campaign</strong></td>
                    <td width="10%">
@if ($deal->campaign_id)
{{ $deal->campaign->name }}
@endif
                    </td>
                    <td width="20%"><strong>Projected Mileage</strong></td>
                    <td width="20%"></td>
                    <td width="10%"></td>
                    <td width="15%"></td>
                </tr>
                <tr>
                    <td width="25%"><strong>Note</strong></td>
                    <td colspan="5">{{ $deal->note }}</td>
                </tr>

            </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table class="table table-striped table-bordered">
            <tbody>
                <tr>
                    <td width="50%">
                        {{ Form::open(array('url' => 'deals/disposition')) }}
                        {{ Form::hidden('deal_id', $deal->id , null, array('class' => 'form-control')) }}
                        {{ Form::hidden('dealer_id', $deal->dealer_id , null, array('class' => 'form-control')) }}
                        <div class="form-group">
                        {{ Form::label('disposition_id', 'Disposition') }}
                        {{ Form::select('disposition_id', $dispositions , null, array('class' => 'form-control')) }}
                        </div>
                        <div class="form-group">
                        {{ Form::submit('Set Disposition', array('class' => 'btn btn-primary')) }}
                        </div>
                        {{ Form::close() }}
                    </td>
                    <td width="50%"> 
                        {{ Form::open(array('url' => 'deals/appointment')) }}
                        {{ Form::hidden('deal_id', $deal->id , null, array('class' => 'form-control')) }}
                        <div class="form-group">
                        {{ Form::label('appointment', 'Appointment') }}
                        {{ Form::text('appointment', Input::old('appointment'), array('class' => 'form-control')) }}
                        </div>
                        <div class="form-group">
                        {{ Form::submit('Set Appointment', array('class' => 'btn btn-primary')) }}
                        </div>
                        {{ Form::close() }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        {{ Form::open(array('url' => 'deals/note')) }}
                        {{ Form::hidden('deal_id', $deal->id , null, array('class' => 'form-control')) }}
                        <div class="form-group">
                        {{ Form::label('notes', 'Notes') }}
                        {{ Form::textarea('note', null,
                            array('class' => 'form-control',
                                  'size' => '30x2')) }}
                        </div>
                        {{ Form::submit('Save!',
                            array('class' => 'btn btn-primary')) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            </tbody>
            </table>
        </td>
    </tr>
</tbody>
</table>

<h1>Showing {{ $deal->name }}</h1>

    <div class="jumbotron text-left">
        <h2>{{ $deal->name }}</h2>
        <p>
            <strong>Customerer:</strong> {{ $deal->dealer->name }}<br>
            <strong>Customer Number:</strong> {{ $deal->customer_number }}<br>
            <strong>Deal Number:</strong> {{ $deal->deal_number }}<br>
            <strong>Name:</strong> {{ $deal->name }}<br>
            <strong>Address 1:</strong> {{ $deal->address_1 }}<br>
            <strong>Address 2:</strong> {{ $deal->address_2 }}<br>
            <strong>City:</strong> {{ $deal->city }}<br>
            <strong>State:</strong> {{ $deal->state }}<br>
            <strong>Zip:</strong> {{ $deal->zip }}<br>
            <strong>Phone:</strong> {{ $deal->phone }}<br>
            <strong>Fax:</strong> {{ $deal->fax }}<br>
            <strong>Email:</strong> {{ $deal->email }}<br>
        </p>
        <h2>Vehicle Information</h2>
        <p>
            <strong>Stock Number:</strong> {{ $deal->stock_number }}<br>
            <strong>Vehicle VIN:</strong> {{ $deal->vehicle_vin }}<br>
            <strong>Vehicle Year:</strong> {{ $deal->vehicle_year }}<br>
            <strong>Vehicle Make:</strong> {{ $deal->vehicle_make }}<br>
            <strong>Vehicle Model:</strong> {{ $deal->vehicle_model }}<br>
            <strong>Vehicle Color:</strong> {{ $deal->vehicle_color }}<br>
            <strong>Purchase Date:</strong> {{ $deal->purchase_date }}<br>
        </p>
        <h2>Call Information</h2>
        <p>
            <strong>First Call:</strong> {{ $deal->first_call }}<br>
            <strong>Results:</strong> {{ $deal->first_call_results }}<br>
            <strong>Second Call:</strong> {{ $deal->second_call }}<br>
            <strong>Results:</strong> {{ $deal->second_call_results }}<br>
            <strong>Third Call:</strong> {{ $deal->third_call }}<br>
            <strong>Results:</strong> {{ $deal->third_call_results }}<br>
            <strong>Final Results:</strong> {{ $deal->final_results }}<br>
            <strong>Last Visit:</strong> {{ $deal->last_visit }}<br>
        </p>
            <strong>Active:</strong> {{ $deal->active }}<br>
    </div>

@stop

