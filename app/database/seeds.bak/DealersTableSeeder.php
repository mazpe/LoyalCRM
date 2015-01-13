<?php
 
class DealersTableSeeder
  extends DatabaseSeeder
{
  public function run()
  {
    $dealers = [
      [
        "dealer_group_id"       => "1",
        "manufacture_id"        => "1",
        "agent_id"              => "5",
        "name"                  => "Hialeah Toyota",
        "email"                 => "info@hialeahtoyota.com",
        "city"                  => "Hialeah",
        "state"                 => "FL",
        "service_phone"         => "786-SER-VICE",
        "hours_of_operation"    => "M-S: 7-5 | S: 10-1",
        "default_rate"          => "2.25",
        "default_records"       => "1000",
        "added_by_id"           => "1",
      ],
      [
        "dealer_group_id"   => "1",
        "manufacture_id"    => "1",
        "agent_id"          => "5",
        "name"              => "South Florida Toyota",
        "email"             => "info@sftoyota.com",
        "city"              => "Doral",
        "state"             => "FL",
        "added_by_id"       => "1",
      ],

      [
        "dealer_group_id"   => "2",
        "manufacture_id"    => "1",
        "agent_id"          => "6",
        "name"              => "Your Toyota",
        "email"             => "info@yourtoyota.com",
        "city"              => "Miami",
        "state"             => "FL",
        "added_by_id"       => "1",
      ],

      [
        "dealer_group_id"   => "2",
        "manufacture_id"    => "2",
        "name"              => "Miami Lakes Chevrolet",
        "email"             => "info@miamilakeschevrolet.com",
        "city"              => "Miami Lakes",
        "state"             => "FL",
        "added_by_id"       => "1",
      ],

      [
        "dealer_group_id"   => "3",
        "manufacture_id"    => "3",
        "name"              => "Miami Gardens BMW",
        "email"             => "info@mgardensbmw.com",
        "city"              => "Miami Gardens",
        "state"             => "FL",
        "added_by_id"       => "1",
      ],

    ];
  
    foreach ($dealers as $dealer) {
      Dealer::create($dealer);
    }
  }
}
