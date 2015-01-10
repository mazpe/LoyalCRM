<?php
 
class DispositionsTableSeeder
  extends DatabaseSeeder
{
  public function run()
  {
    $dispositions = [
      [
        "name"          => "No Calls Yet",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "Call 1 - H",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "Call 1 - C",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "Call 1 - W",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "Call 2 - H",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "Call 2 - C",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "Call 2 - W",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "Call 3 - H",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "Call 3 - C",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "Call 3 - W",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "Appointment - Set - H",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "Appointment - Set - C",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "Appointment - Set - W",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "Appointment - Tent - H",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "Appointment - Tent - C",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "Appointment - Tent - W",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "Do Not Call - C",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "Do Not Call - H",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "Do Not Call - W",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "Do Not Call - ALL",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "Not Interested",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "Not Ready Yet",
        "added_by_id"   => "1",
      ],

    ];
  
    foreach ($dispositions as $disposition) {
      Disposition::create($disposition);
    }
  }
}
