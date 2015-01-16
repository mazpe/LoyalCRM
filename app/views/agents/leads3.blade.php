@extends("layout")
@section("content")

<?php
$i = 1;
?>

<nav class="navbar navbar-inverse">
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('directions') }}">Plan Route</a>
        <li><a href="{{ URL::to('dealergroups/create') }}">Create Dealer Group</a>
        <li><a href="{{ URL::to('dealers/create') }}">Create Dealer</a>
    </ul>
</nav>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table border="0" width="100%">
<tr>
<td width="50%" valign="top" style="padding: 10px">

<h3><font color="f37622">Search/Sort Criterias</font></h3>
<button class="hidetext" >Hide/Show</button>

<div class="criteria" style="display:none">
<br />

{{ Form::open(array('url' => 'agents/'.$agent->id.'/dealer/search')) }}
<table class="table table-striped table-bordered table-condensed">
    <tbody>
        <tr>
            <td>
@if(Auth::user()->hasRole('Admin'))
    <div class="form-group">
        {{ Form::label('agent_id', 'Agent') }}
        {{ Form::select('agent_id', $agents,
            Input::old('agent_group_id'), array('class' => 'form-control')) }}
    </div>
@endif
    <div class="form-group">
        {{ Form::label('dealer_group_id', 'Dealer Group') }}
        {{ Form::select('dealer_group_id', $dealer_groups, 
            Input::old('dealer_group_id'), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('dealer', 'Dealer Name (Ex. Ivory%)') }}
        {{ Form::text('dealer', Input::old('dealer'),array('class' => 'form-control') ) }}
    </div>
    <div class="form-group">
        {{ Form::label('manufacture_id', 'Manufactures') }}
        {{ Form::select('manufacture_id', $manufactures, 
            Input::old('manufacture_id'), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('stage_id', 'Stages') }}
        {{ Form::select('stage_id', $stages, Input::old('stage_id'),
            array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('last_contact_from', 'Last Contact:') }}
        {{ Form::text('last_contact_from', Input::old('last_contact_from'), 
            array('id' => 'last_contact_from') ) }}
        {{ Form::text('last_contact_to', Input::old('last_contact_to'), 
            array('id' => 'last_contact_to')) }}
    </div>
    <div class="form-group">
        {{ Form::label('next_contact_from', 'Next Contact:') }}
        {{ Form::text('next_contact_from', Input::old('next_contact_from'),
            array('id' => 'next_contact_from') ) }}
        {{ Form::text('next_contact_to', Input::old('next_contact_to'),
            array('id' => 'next_contact_to')) }}
    </div>
    <div class="form-group">
        {{ Form::label('sort_1', 'Sort 1:') }}
        {{ Form::select('sort_1', array (''=>'','dealer_groups.name' => 'Dealer Group','dealers.name' => 'Dealer', 'manufactures.name' => 'Manufactures', 'stages.name' => 'Stages', 'last_contat_date' => 'Last Contact', 'next_contact_date' => 'Next Contact') , 'next_contact_date') }}
        {{ Form::select('sort_1_dir', array ('ASC' => 'ASC', 'DESC' => 'DESC') , Input::old('sort_direction')) }}

{{ Form::label('sort_2', 'Sort 2:') }}
        {{ Form::select('sort_2', array (''=>'','dealer_groups.name' => 'Dealer Group','dealers.name' => 'Dealer', 'manufactures.name' => 'Manufactures', 'stages.name' => 'Stages', 'last_contat_date' => 'Last Contact', 'next_contact_date' => 'Next Contact') , 'stages.name') }}
        {{ Form::select('sort_2_dir', array ('ASC' => 'ASC', 'DESC' => 'DESC') , Input::old('sort_direction')) }}

{{ Form::label('sort_3', 'Sort 3:') }}
        {{ Form::select('sort_3', array (''=>'','dealer_groups.name' => 'Dealer Group','dealers.name' => 'Dealer', 'manufactures.name' => 'Manufactures', 'stages.name' => 'Stages', 'last_contat_date' => 'Last Contact', 'next_contact_date' => 'Next Contact') , 'dealer_groups.name') }}
        {{ Form::select('sort_3_dir', array ('ASC' => 'ASC', 'DESC' => 'DESC') , Input::old('sort_direction')) }}

{{ Form::label('sort_4', 'Sort 4:') }}
        {{ Form::select('sort_4', array (''=>'','dealers.dealer_groups.name' => 'Dealer Group','dealers.name' => 'Dealer', 'manufactures.name' => 'Manufactures', 'stages.name' => 'Stages', 'last_contat_date' => 'Last Contact', 'next_contact_date' => 'Next Contact') , 'dealers.name') }}
        {{ Form::select('sort_4_dir', array ('ASC' => 'ASC', 'DESC' => 'DESC') , Input::old('sort_direction')) }}
    </div>
    <div class="form-group">
        {{ Form::submit('Search!', array('class' => 'btn btn-primary')) }}
    </div>
            </td>
        </tr>
    </tbody>
</table>
{{ Form::close() }}
</div>
<br>
<br>

</div>

</td>
<td width="50%" valign="top">

    <h3><font color="f37622">Stages</font></h3>

<button class="hide-show-stages-button" >Hide/Show</button>

<div class="hide-show-stages" style="display:none">
<br />

    <table class="table table-striped table-bordered table-condensed">
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>#</th>
            <th>%</th>
         </tr>
        </thead>
        <tbody>
<?php
$count = 0;
?>

{{ dd($stages_counter) }}
@foreach($stages_counter as $key => $value)
<?php
$count += $value->count;

if ($value->name == "Active") {
        echo "<tr style=\"color: #0000FF;\">";
} elseif  ($value->name == "Pending Activation") {
         echo "<tr style=\"color: #008000\">";
} elseif ($value->name == "Sold / CIT") {
         echo "<tr style=\"color: #FF0000;\">";
} elseif ($value->name == "Very Hot") {
         echo "<tr style=\"color: #FF0000;\">";
} elseif ($value->name == "Medium") {
         echo "<tr style=\"color: orange;\">";
} elseif ($value->name == "Cold") {
         echo "<tr style=\"color: lightblue;\">";
} elseif ($value->name == "Dead") {
         echo "<tr style=\"color: #EBDDE2;\">";
} else {
         echo "<tr>";
}
?>
            <td style="padding: 1px;spacing: 1px"><small>{{ $value->name }}</small></td>
            <td style="padding: 1px"><small>{{ $value->description }}</small></td>
            <td style="padding: 1px" align="center"><small>{{ $value->count }}</small></td>
            <td style="padding: 1px">
            <small>
@if ($dealers_count > 0)
            {{ number_format($value->count/$dealers_count*100,2, '.', ',') }} %
@else
    0
@endif
            </small>
        </font>
            </td>
        </tr>
    @endforeach
        <tr style="color: #3B170B;">
            <td style="padding: 1px;spacing: 1px"><small>Dealers</small></td>
            <td style="padding: 1px"><small>Total Dealers</small></td>
            <td style="padding: 1px" align="center"><small>{{ $dealers_count }}</small></td>
            <td style="padding: 1px"> <small>100% </small> </td>
        </tr>

        </tbody>
    </table>
</div>

</td>
</tr>
</table>

{{ Form::open(array('url' => 'directions/dealers','name' => 'testForm', 'id' => 'testForm')) }}
      {{ Form::submit('Route', array('class' => 'btn btn-primary')) }}
<br>
<br>





<table class="table table-striped table-bordered table-condensed table-hover">
    <thead>
        <tr>
            <th></th>
            <th width="3%">ID</th>
            <th>Dealer Group</th>
            <th>Name</th>
            <th>Manufacture</th>
            <th>Stage</th>
            <th with="15%">Next Contact</th>
            <th>Contact Type</th>
        </tr>
    </thead>
    <tbody>
    @foreach($dealers as $key => $value)
@if ($value->name == "Active") {
        <tr style="color: #0000FF;">
@elseif ($value->name == "Pending Activation") 
        <tr style="color: #008000">
@elseif ($value->name == "Sold / CIT")
        <tr style="color: #FF0000;">
@elseif ($value->stage == "Very Hot")
        <tr style="color: #FF0000;">
@elseif ($value->stage == "Hot")
        <tr style="color: #E55B3C;">
@elseif ($value->stage == "Medium")
        <tr style="color: orange;">
@elseif ($value->stage == "Cold")
        <tr style="color: lightblue;">
@elseif ($value->stage == "Dead")
        <tr style="color: #EBDDE2;">
@else
        <tr>
@endif
            <td>
            <input type="checkbox" class="checkBoxClass"
            name="dealer_id_{{ $value->dealer_id }}" value="{{ $value->dealer_id }}"
            id="Checkbox{{ $value->dealer_id }}" onclick="countCheckboxes()"/>
            </td>

            <td> <small>{{ $i++ }}</small></td>
            <td>
            <small>
            @if ($value->dealergroup)
                {{ $value->dealergroup }}
            @endif
            </small>
            </td>
            <td>
            <small>
            <a href="{{ URL::to('dealers/' . $value->dealer_id ) }}">
                {{ $value->dealer }}
            </a>
            </small>
            </td>
            <td>
            <small>
            @if ($value->manufacture)
                {{ $value->manufacture }}
            @endif
            </small>
            </td>
            <td>
            <small>
        <span title="">
            @if ($value->stage)
                {{ $value->stage }}
            @endif
            </span>
            </small>
            </td>
            <td>
            <small>
            @if ($value->next_contact_date)
                {{ date("m-d-Y g:i A",strtotime($value->next_contact_date)) }}
                 - {{ date("l",strtotime($value->next_contact_date)) }}
            @endif
            </small>
            </td>
            <td> <small>{{ $value->next_contact_type }} </small></td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
        <tr> <td colspan="8" align="right"> <a href="#">^top</a> </td></tr>
    </tfoot>
</table>


@stop

