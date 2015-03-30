@extends("layout")
@section("content")

<h2>
<a href="{{ URL::to('agents/'.$agent->id.'/profile') }}">
{{ $agent->name }}
</a>
</h2>

<h3>Reports: Agent Calls and Appointments Stats</h3>

<table class="table table-striped table-bordered table-hover table-condensed">
<tr>
    <th width="25%">&nbsp;</th>
    <th width="25%"> Calls </th>
    <th width="25%"> Appt - SET </th>
    <th width="25%"> Appt - ALL </th>
</tr>
<tr>
    <td> </td>
    <td> </td>
    <td>{{ $appointments_count }} </td>
    <td>{{ $appointments_total_count }}</td>
</tr>
<tr>
    <td> Cell </td>
    <td> {{ $calls_cell_count }}</td>
    <td> </td>
    <td> </td>
</tr>
<tr>
    <td> Home </td>
    <td> {{ $calls_home_count }}</td>
    <td> </td>
    <td> </td>
</tr>
<?php
    $subtotal = $calls_cell_count + $calls_home_count;
    if ($subtotal > 0 && $appointments_count) {
        $st_appt_set = ($appointments_count / $subtotal) * 100;
        $st_appt_set =  number_format($st_appt_set, 2, '.', ',');
    } else {
        $st_appt_set = 0;
    }

    if ($subtotal > 0 && $appointments_total_count) {
        $st_appt_total = ($appointments_total_count / $subtotal) * 100;
        $st_appt_total =  number_format($st_appt_total, 2, '.', ',');
    } else {
        $st_appt_total = 0;
    }
?>
<tr>
    <td><font color="red"><strong> Sub-Total </strong></font></td>
    <td><font color="red"><strong> {{ $subtotal }} </strong></font></td>
    <td><font color="red"><strong> {{ $st_appt_set }}% </strong></font></td>
    <td><font color="red"><strong> {{ $st_appt_total }}% </strong></font></td>
</tr>
<tr>
    <td> Work </td>
    <td> {{ $calls_work_count }}</td>
    <td> </td>
    <td> </td>
</tr>
<tr>
    <td> <strong> All Total </strong></td>
    <td> <strong> {{ $callstotal }} </strong></td>
    <td>
        <strong>
        {{ number_format($appointments_count_perc, 2, '.', ',') }}% 
        </strong>
    </td>
    <td>
        <strong>
        {{ number_format($appointments_total_count_perc, 2, '.', ',') }}% 
        </strong>
    </td>
</tr>
</table>

@stop
