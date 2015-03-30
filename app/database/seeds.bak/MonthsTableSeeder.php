<?php
 
class MonthsTableSeeder
  extends DatabaseSeeder
{
  public function run()
  {
    $months = [
      [
        "name"          => "January 31",
        "number"        => "1",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "February 28",
        "number"        => "2",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "March 31",
        "number"        => "3",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "April 30",
        "number"        => "4",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "May 31",
        "number"        => "5",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "June 30",
        "number"        => "6",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "July 31",
        "number"        => "7",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "August 30",
        "number"        => "8",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "September 30",
        "number"        => "9",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "October 31",
        "number"        => "10",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "November 30",
        "number"        => "11",
        "added_by_id"   => "1",
      ],
      [
        "name"          => "December 31",
        "number"        => "12",
        "added_by_id"   => "1",
      ],

    ];
  
    foreach ($months as $month) {
      Month::create($month);
    }
  }
}
