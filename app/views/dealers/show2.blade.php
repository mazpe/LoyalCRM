@extends("layout")
@section("content")
<?php
$current_month =  ltrim(date('m'), '0');
if ($dealermonth) {
    $dm_records = $dealermonth->records;
    $dm_rate    = $dealermonth->rate;
} else {
    $dm_records = 0;
    $dm_rate    = 0;
}

if ($totalassigned > 0) {
    $totalassigned = $totalassigned;
} else {
    $totalassigned = 0;
}

$completed_calls = $dm_records - $remaining_count;
$assigned_completed_calls =  $totalassigned - $remaining_count;
$remaining_count2 = $dealermonth->records - $assigned_completed_calls;

?>

@if (Auth::user()->hasRole('Admin'))
<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('dealers') }}">Dealer</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('dealers/'. $dealer->id .'/create_month') }}">Create a Month</a>
        <li><a href="{{ URL::to('dealers/'. $dealer->id .'/assignment') }}">Assignment</a>
    </ul>
</nav>
@endif

<h3><strong>{{ $dealer->name }}</strong></h3>

@if ( 1 == 1 )
<table class="table table-striped table-bordered table-condensed">
<tbody>
    <tr>
        <td width="50%">
        
            <table class="table table-striped table-bordered table-condensed">
                <tr>
                    <td colspan="2" class="text-center">
                    <strong>CALLS AND DISPOSITIONS</strong>
                    </td>
                </tr>
                <tr>
                    <td><strong><small>End Date</small></strong></td>
                    <td>
                    {{ Form::select('month_id', $months , $month, 
                        array('class' => 'form-control small', 
                            'id' => 'selectbox_id')) }}
                    </td>
                </tr>
                <tr>
                    <td><strong><small>Days Left</small></strong></td>
                    <td>
                    <small>
                    @if ($month == $current_month)
                    {{ $days_to_endofmonth }}
                    @endif
                    </small>
                    </td>
                </tr>
                <tr>
                    <td width="30%">
                    <strong>
                    <small>
@if (Auth::user()->hasRole('Admin'))
     <a  href="{{ URL::to('dealers/' .$dealer->id .'/month/'. $month .'/disposition/assigned') }}">
    Assigned Now
    </a>
@else
    Assigned Now
@endif
                    </strong>
                    </small>
                    </td>
                    <td><small>
    {{ $totalassigned }} / {{ $dm_records }} 
    (completed: {{ $assigned_completed_calls }} / remaining: {{ $remaining_count }})
                </small></td>
                </tr>
            <tr>
            <td colspan="2">

            <table  class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <tr>
                    <th width="40%">Disposition</th>
                    <th width="20%">Calls</th>
                </tr>
            </thead>
            <tbody>
@foreach($callrecords as $key => $value)
                <tr>
                    <td width="45%">
                    <small>
                    <strong>
 <a  href="{{ URL::to('dealers/' .$dealer->id .'/month/'. $month  .'/disposition/'. $value->disposition_id) }}">
{{ $value->name }}
</a>
                    </small>
                    </strong></td>
                    <td><small>{{ $value->calls }}</small></td>
                </tr>
@endforeach
                <tr>
                    <td>
@if (Auth::user()->hasRole('Admin'))
<a  href="{{ URL::to('dealers/' .$dealer->id .'/month/'. $month  .'/disposition/total') }}">
                        <strong><small>Total Calls</small></strong>
</a>
@else
<strong><small>Total Calls</small></strong>
@endif
                    </td>
                    <td>
                        <strong><small>{{ $callstotal }}</small></strong>
                    </td>
                </tr>
                <tr>
                    <td><strong><small>
                    Appointment Set Total 
<a href="{{ URL::to('dealers/' .$dealer->id .'/appointments_by_appt/month/'. $month) }}">
(Appt Date) 
</a>

<a href="{{ URL::to('dealers/' .$dealer->id .'/appointments/month/'. $month) }}">
(Call Date)
</a> 
                    </small></strong></td>
                    <td>
                    <strong><small>{{ $appointments_count }}</small></strong>
                    </td>
                </tr>
                <tr>
                    <td><strong><small>
                    <font color="red">
                    Appointments ALL Total
                    </font>
                    </small></strong></td>
                    <td>
                    <font color="red">
                    <strong>
                        <small>{{ $appointments_total_count }}</small>
                    </strong>
                    </font>
                    </td>
                </tr>

            </tbody>
            </table>


            </td>
            </tr>
            </table>
 

        </td>



        
        <td>

            <table class="table table-striped table-bordered table-condensed">
            <tbody>
                <tr>
                    <td colspan="4" class="text-center">
                    <strong>REPAIR ORDERS AND RESPONSE RATE</strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><small><strong>End Date</strong></small></td>
                    <td colspan="2"><small>{{ date("m-d-Y",strtotime($roenddate)) }}</small></td>
                </tr>
                <tr>
                    <td colspan="2"><small><strong>Days Left</strong></small></td>
                    <td colspan="2"><small>{{ $days_to_roendofmonth }}</small></td>
                </tr>
                <tr>
                    <td colspan="2"><small><strong>Total Assigned for Month</strong></small></td>
                    <td colspan="2"><small>
            {{ $dm_records }}
                </small></td>
                </tr>
                <tr>
                    <td colspan="2"><small><strong>RO Number</strong></small></td>
                    <td colspan="2">
                    <small>
                    <a  href="{{ URL::to('dealers/' .$dealer->id .'/repairorders/month/'. $month) }}">
                        {{ $ro_count }}
                    </a>
                    </small>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><small><strong>RO Revenue</strong></small></td>
                    <td colspan="2">
                    <small> {{ number_format($roamount, 2, '.', ',') }} </small>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                    <small><strong>RO Average</strong></small>
                    </td>
                    <td colspan="2">
                    <small>
                    @if ( $ro_count > 0 )
                    {{ number_format($roamount / $ro_count, 2, '.', ',') }}
                    @endif
                    </small>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                    <small><strong>Response Rate</strong></small>
                    </td>
                    <td colspan="2">
                    <small>
@if ($ro_count > 0)
{{ number_format((($ro_count / $dm_records) * 100), 2, '.', ',') }}%
@endif
                    </small>
                    </td>
                </tr>
            </tbody>
            </table>


            <table class="table table-striped table-bordered table-condensed">
            <tbody>
                <tr>
                    <td colspan="3" align="center"><strong>ROI</strong></td>
                </tr>
                <tr>
                    <td colspan="3">
                    <small>
                    This reflects the ROI the program provided in the report month selected.
                    </small>
                    </td>
                </tr>
                <tr>
                    <td width="60%"><small><strong>Monthly Cost</strong></small></td>
                    <td width="20%"> <small>$ {{ $dm_rate }} </small> </td>
                    <td width="20%">
                    <small> $ {{ $dm_rate * $dm_records }} </small>
                    </td>
                </tr>
                <tr>
                    <td><small><strong>ROI</strong></small></td>
                    <td>&nbsp;</td>
                    <td>
                    <small>
@if ($dm_records > 0)
{{  number_format($roamount / ($dm_rate * $dm_records), 0, '.', ',') }} to 1
@else 
    0 to 1
@endif
                    </small>
                    </td>
                </tr>
            </tbody>
            </table>



@if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Dealer'))
            <table class="table table-striped table-bordered table-condensed">
            <tbody>
                <tr>
                    <td colspan="3" align="center">
                    <strong>Statistical Summary</strong>
                    </td>
                </tr>
                <tr>
                    <td width="60%">
                        <small>
                        <strong>Total Customer Records to Call</strong>
                        </small>
                    </td>
                    <td width="20%"><small>
                    {{ $dm_records }}
                    </small></td>
                    <td width="20%">&nbsp;</td>
                </tr>
                <tr>
                    <td width="60%">
                        <small>
                        <strong>Total Customer Records Completed</strong>
                        </small>
                    </td>
                    <td width="20%"><small>{{ $assigned_completed_calls }}</small></td>
                    <td width="20%"><small>
@if ($assigned_completed_calls && $dm_records)
                    {{  number_format( ($assigned_completed_calls / $dm_records) * 100 , 2, '.', ',') }}%
@endif
                    </small></td>
                </tr>
                <tr>
                    <td>
                        <font color="red">
                        <small> <strong>Total Appointments</strong> </small>
                        </font>
                    </td>
                    <td>
                        <font color="red">
                        <strong>
                        <small>{{ $appointments_total_count }}</small>
                        </strong>
                        </font>
                    </td>
                    <td>
                    <strong>
                    <small>
                    <font color="red">
<?php
if ($appointments_total_count && $completed_calls) {
    $appointments_perc = ($appointments_total_count / $assigned_completed_calls) * 100;
    echo number_format( $appointments_perc , 2, '.', ',')."%";
}
?>
                    </font>
                    </small>
                    </strong>
                    </td>
                </tr>
            </tbody>
            </table>


            <table class="table table-striped table-bordered table-condensed">
            <tbody>
                <tr>
                <td colspan="3" align="center"><strong>Projections</strong></td>
                </tr>
                <tr>
                    <td width="60%"><small>
                        <strong>Total Customer Records Incomplete</strong>
                    </small></td>
                    <td width="20%"><small>
                        {{ $remaining_count2 }}
                    </small></td>
                    <td width="20%"><small>
<?php
if ($appointments_total_count && $remaining_count2) {
    $incompleted_perc = ($remaining_count2 / $dm_records) * 100;
    echo  number_format( $incompleted_perc , 2, '.', ',')."%";
}
?>
                    </small></td>
                </tr>
                <tr>
                    <td><small>
                        <strong>Additional Appointments (Projected)</strong>
                    </small></td>
                    <td>
<small>
<?php
if ($appointments_total_count != 0 && $completed_calls != 0 ) {
    $additional_appointments 
        = number_format( $remaining_count2 * ($appointments_perc/100) , 0, '.', ',');
            //$remaining_count * ($appointments_total_count / $completed_calls) 
} else {
    $additional_appointments = 0;
}
    echo $additional_appointments;
?>
</small>
                    </td>
                    <td>
                    <small>
                    </small>
                    </td>
                </tr>
                <tr>
                    <td>
                    <small>
                        <strong>Total Appointments (Projected)</strong>
                    </small>
                    </td>
                    <td>
                    <small>
<?php
    $projected_appointments = 
        number_format( $additional_appointments + $appointments_total_count
        , 0, '.', ',') ;
    echo $projected_appointments;
?>
                    </small>
                    </td>
                    <td>
                    <small>
                    </small>
                    </td>
                </tr>

                <tr>
                    <td>
                    <small>
                        <strong>Additional RO's from Calls (Projected)</strong>
                    </small>
                    </td>
                    <td>
                    <small>
<?php
    $additional_ros =  number_format( $projected_appointments * ($dealer->ro_percent/100) , 0, '.', ',');
    echo $additional_ros;
?>
                    </small>
                    </td>
                    <td>
                    <small>
                    </small>
                    </td>
                </tr>

                <tr>
                    <td>
                    <small>
                        <strong>Total RO's (Projected)</strong>
                    </small>
                    </td>
                    <td>
                    <small>
<?php
    $total_ros =  number_format($projected_appointments + $additional_ros, 0, '.', ',');
    echo $total_ros;
?>
                    </small>
                    </td>
                    <td>
                    <small>
                    </small>
                    </td>
                </tr>

                <tr>
                    <td><small>
                        <strong>Avg RO Amt / Total Rev. (Projected)</strong>
                    </small></td>
                    <td><small>{{ $dealer->avg_ro }}</small></td>
                    <td>
                    <small>
${{ number_format($total_ros * $dealer->avg_ro , 2, '.', ',') }}
                    </small>
                    </td>
                </tr>
                <tr>
                    <td><small>
                        <strong>ROI (Projected)</strong>
                    </small></td>
                    <td><small> </small></td>
                    <td>
                    <small>
@if ($dm_records > 0)
{{  number_format(
$total_ros * $dealer->avg_ro
/
($dm_rate * $dm_records)

, 0, '.', ',') }} to 1
@endif

                    </small>
                    </td>
                </tr>
            </tbody>
            </table>


@endif


        </td>
    </tr>
</tbody>
</table>

<table class="table table-striped table-bordered table-condensed">
    <tr>
        <th width="15%">Months</th>
        <th width="10%">Rate</th>
        <th width="15%">Records</th>
        <th>Note</th>
@if (Auth::user()->hasRole('Admin'))
        <th width="10%">&nbsp;</th>
@endif
    </tr>
@foreach($dealermonths as $key => $value)
    <tr>
        <td><small> {{ $value->month->name }}</small></td>
        <td><small> ${{ $value->rate }}</small></td>
        <td><small> {{ $value->records }}</small></td>
        <td><small> {{ $value->note }}</small></td>
    @if (Auth::user()->hasRole('Admin'))
        <td>
<a href="{{ URL::to('dealers/'.$dealer->id.'/month/'. $value->month_id .'/edit' ) }}">
            <small>Edit</small>
</a>
        </td>
    @endif
    </tr>
@endforeach
</table>

<!-- if (@dealermonth) -->
@else 

    <p>
    The month for this dealer has not yet been created. Please contact your Sales Representative.
    </p>

<!-- if (@dealermonth) -->
@endif 




<button class="hidetext">Dealer Information: Hide/Show</button>
<br />
<br />

<div class="criteria" style="display:none">

    <div class="jumbotron text-left">
        <h3><strong>{{ $dealer->name }}</strong></h3>
        <p>
        <small>
            <strong>Dealer Group:</strong> {{ $dealer->dealergroup->name }}<br>
            <strong>Manufacture:</strong> {{ $dealer->manufacture->name }}<br />
            <strong>Agent:</strong>
            @if ($dealer->agent_id)
                {{ $dealer->agent->name }}
            @endif
        </small>
        </p>
        <p>
        <small>
            <strong>Address 1:</strong> {{ $dealer->address_1 }}<br>
            <strong>Address 2:</strong> {{ $dealer->address_2 }}<br>
            <strong>City:</strong> {{ $dealer->city }}<br>
            <strong>State:</strong> {{ $dealer->state }}<br>
            <strong>Zip:</strong> {{ $dealer->zip }}<br>
            <strong>Phone:</strong> {{ $dealer->phone }}<br>
            <strong>Fax:</strong> {{ $dealer->fax }}<br>
            <strong>Email:</strong> {{ $dealer->email }}<br>
        </small>
        </p>
        <h3><strong>Contact</strong></h3>
        <p>
        <small>
            <strong>Contact:</strong> {{ $dealer->contact }}<br>
            <strong>Phone:</strong> {{ $dealer->contact_phone }}<br>
            <strong>Email:</strong> {{ $dealer->contact_email }}<br>
            <strong>Service Phone:</strong> {{ $dealer->service_phone }}<br>
            <strong>Hours Of Operation:</strong> {{ $dealer->hours_of_operation }}<br>
        </small>
        </p>
        <h3><strong>Service</strong></h3>
        <p>
        <small>
            <strong>Appointment Recipients:</strong> {{ $dealer->appt_recipients }}<br>
            <strong>Default Rate:</strong> {{ $dealer->default_rate }}<br>
            <strong>Default Records:</strong> {{ $dealer->default_records }}<br>
            <strong>Average RO:</strong> {{ $dealer->avg_ro }}<br>
            <strong>RO Percent:</strong> {{ $dealer->ro_percent }}<br>
        </small>
        </p>

        <p>
        <small>
            <strong>Added By:</strong> {{ $dealer->added_by->name }}<br>
            <strong>Active:</strong> {{ $dealer->active }}<br>
        </small>
        </p>


    </div>
</div>

@stop
