<?php
 
class CampaignsTableSeeder
  extends DatabaseSeeder
{
  public function run()
  {
    $campaigns = [
      [
        "dealer_id"     => "1",
        "name"          => "5k Campaign",
        "added_by_id"   => "1",
      ],
      [
        "dealer_id"     => "2",
        "name"          => "10k Campaign",
        "added_by_id"   => "1",
      ],
      [
        "dealer_id"     => "3",
        "name"          => "20k Campaign",
        "added_by_id"   => "1",
      ],

    ];
  
    foreach ($campaigns as $campaign) {
      Campaign::create($campaign);
    }
  }
}
