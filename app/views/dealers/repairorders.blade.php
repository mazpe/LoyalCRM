@extends("layout")
@section("content")

<h3>Repair Orders</h3> 
Total ROs: ({{ $totalros }}) - From: {{ date("m-d-Y",strtotime($startofmonth)) }} To: {{ date("m-d-Y",strtotime($roenddate)) }}

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered table-condensed table-hover">
    <thead>
        <tr>
            <th><strong>RO #</strong></th>
            <th><strong>Date</strong></th>
            <th><strong>CR Name</strong></th>
            <th><strong>RO Name</strong></th>
            <th><strong>VIN</strong></th>
            <th><strong>Amount</strong></th>
        </tr>
    </thead>
    <tbody>
<?php 
$amount = 0;
?>
    @foreach($repairorders as $key => $value)
        <tr>
            <td> <small>{{ $value->number }}</small></td>
            <td> <small>{{ date("m-d-Y",strtotime($value->date)) }}</small></td>
            <td>
<small>
<a href="{{ URL::to('deals/'. $value->deal_id) }}">
{{ $value->cr_name }}
</a>
</small>
            </td>
            <td><small>{{ $value->ro_name }}</small></td>
            <td><small>{{ $value->vehicle_vin }}</small></td>
            <td><small>${{ $value->amount }}</small></td>
        </tr>
<?php
$amount += $value->amount;
?>
    @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td><strong>TOTALS ({{ $totalros }})</strong></td>
            <td></td> 
            <td></td> 
            <td></td> 
            <td></td> 
            <td>${{  number_format($amount, 2, '.', ',') }}</td> 
        </tr>
    </tfoot>
</table>


@stop
