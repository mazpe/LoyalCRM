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

    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
      #panel {
        position: absolute;
        top: 5px;
        left: 50%;
        margin-left: -180px;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script>
    var directionsDisplay;
    var directionsService = new google.maps.DirectionsService();
    var map;

    function initialize() {
        directionsDisplay = new google.maps.DirectionsRenderer();

        var broward = new google.maps.LatLng(26.1457239,-80.4779812);
        var mapOptions = {
            zoom: 10,
            center: broward
        }
        map = new google.maps.Map(
            document.getElementById('map-canvas'), mapOptions
        );

        directionsDisplay.setMap(map);
    }

function calcRoute() {
  var start = document.getElementById('start').value;
  var end = document.getElementById('end').value;
  var waypts = [];
  var checkboxArray = document.getElementById('waypoints');
  for (var i = 0; i < checkboxArray.length; i++) {
    if (checkboxArray.options[i].selected == true) {
      waypts.push({
          location:checkboxArray[i].value,
          stopover:true});
    }
  }

  var request = {
      origin: start,
      destination: end,
      waypoints: waypts,
      optimizeWaypoints: true,
      travelMode: google.maps.TravelMode.DRIVING
  };
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
      var route = response.routes[0];
      var summaryPanel = document.getElementById('directions_panel');
      summaryPanel.innerHTML = '';

      var dest = document.getElementById("waypoints");
      var start = document.getElementById("start");
      var end = document.getElementById("end");

      var result = [];
      for (var x = 0; x < dest.options.length; x++) {
        if (dest.options[x].selected) {
            result.push(dest.options[x].text);
        }
      }            

      // For each route, display summary information.
      
      for (var i = 0; i < route.legs.length; i++) {
        var routeSegment = i + 1;
        summaryPanel.innerHTML += '<b>Route Segment: ' + 
            routeSegment + '</b><br> ';
        if (routeSegment == route.legs.length) {
          summaryPanel.innerHTML += '<b>' + 
            end.options[end.selectedIndex].text + '</b><br>';
        } else {
          summaryPanel.innerHTML += '<b>' + 
            result[route.waypoint_order[i]] + '</b><br>';
        }
        summaryPanel.innerHTML += '<b>From: </b>' + 
            route.legs[i].start_address + '<br>';
        summaryPanel.innerHTML += '<b>To: </b>' + 
            route.legs[i].end_address + '<br>';
        summaryPanel.innerHTML += route.legs[i].distance.text + ' - ';
        summaryPanel.innerHTML += route.legs[i].duration.text + '<br><br>';
      }
    }
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body>
    <div id="map-canvas" style="float:left;width:70%;height:100%;"></div>
    <div id="control_panel" style="float:right;width:30%;text-align:left;padding-top:20px">
    <div style="margin:20px;border-width:2px;">
    <b>Start:</b>
        {{ Form::select('start', $dealers, Input::old('dealer_group_id'), array('id' => 'start')) }}
    <br>
    <b>Waypoints:</b> <br>
    <i>(Ctrl-Click for multiple selection)</i> <br>
        {{ Form::select('waypoints', $dealers, Input::old('dealer_group_id'), array('multiple'=>true, 'size' => '15', 'id' => 'waypoints')) }}
    <br>
    <b>End:</b>
        {{ Form::select('end', $dealers, Input::old('dealer_group_id'), array('id' => 'end')) }}
    <br>
      <input type="submit" onclick="calcRoute();">
    </div>
    <div id="directions_panel" style="margin:20px;background-color:#FFEE77;"></div>
    </div>


@stop
