<?php
 
class DealerGroupsTableSeeder
  extends DatabaseSeeder
{
  public function run()
  {
    $dealergroups = [
      [
        "name"          => "SF Dealer Group",
        "city"          => "Miami",
        "state"         => "FL",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "Miller Time Group",
        "city"          => "FT. Lauderdale",
        "state"         => "FL",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "USA Automotive",
        "city"          => "Atlanta",
        "state"         => "GA",
        "added_by_id"   => "1",
      ],

    ];
  
    foreach ($dealergroups as $dealergroup) {
      DealerGroup::create($dealergroup);
    }
  }
}
