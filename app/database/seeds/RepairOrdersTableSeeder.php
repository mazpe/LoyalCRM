<?php
 
class RepairOrdersTableSeeder
  extends DatabaseSeeder
{
  public function run()
  {
    $repairorders = [
      [
        "dealer_id"     => "1",
        "number"        => "1001",
        "date"          => "2014-06-10",
        "status"        => "Closed",
        "amount"        => "100.00",
        "added_by_id"   => "1",
      ],
      [
        "dealer_id"     => "1",
        "number"        => "1011",
        "date"          => "2014-06-01",
        "status"        => "Closed",
        "amount"        => "110.00",
        "added_by_id"   => "1",
      ],
      [
        "dealer_id"     => "1",
        "number"        => "1033",
        "date"          => "2014-06-12",
        "status"        => "Closed",
        "amount"        => "200.00",
        "added_by_id"   => "1",
      ],
      [
        "dealer_id"     => "1",
        "number"        => "1031",
        "date"          => "2014-06-10",
        "status"        => "Closed",
        "amount"        => "120.00",
        "added_by_id"   => "1",
      ],
      [
        "dealer_id"     => "1",
        "number"        => "1021",
        "date"          => "2014-06-15",
        "status"        => "Closed",
        "amount"        => "250.00",
        "added_by_id"   => "1",
      ],

    ];
  
    foreach ($repairorders as $repairorder) {
      RepairOrder::create($repairorder);
    }
  }
}
