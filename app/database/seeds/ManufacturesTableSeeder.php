<?php
 
class ManufacturesTableSeeder
  extends DatabaseSeeder
{
  public function run()
  {
    $manufactures = [
      [
        "name"          => "Toyota",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "Chevrolet",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "Mercedes",
        "added_by_id"   => "1",
      ],

    ];
  
    foreach ($manufactures as $manufacture) {
      Manufacture::create($manufacture);
    }
  }
}
