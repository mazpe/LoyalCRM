<h2>Appointment Alert</h2>
<table>
<tr>
    <td width="150px">Customer Name:</td>
    <td>{{ $name }}</td>
</tr>
<tr>
    <td>Yr:</td>
    <td>{{ $vehicle_year }}</td>
</tr>
<tr>
    <td>Make:</td>
    <td>{{ $vehicle_make }}</td>
</tr>
<tr>
    <td>Model:</td>
    <td>{{ $vehicle_model }}</td>
</tr>
<tr>
    <td>VIN:</td>
    <td>{{ $vehicle_vin }}</td>
</tr>
<tr>
    <td>Last Service Mileage:</td>
    <td>{{ $vehicle_mileage }}</td>
</tr>
<tr>
    <td>Last Service Date:</td>
    <td>{{ $last_visit }}</td>
</tr>
<tr>
    <td>Contact Date & Time:</td>
    <td>{{ $contacted }}</td>
</tr>
<tr>
    <td>Appt Date & Time:</td>
    <td>{{ $appointment }}</td>
</tr>
<tr>
    <td colspan="2">Note: {{ $note }}</td>
</tr>


</table>
