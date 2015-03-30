<?php
 
class RolesTableSeeder
  extends DatabaseSeeder
{
  public function run()
  {
    $roles = [
      [
        "name"          => "Admin",
      ],
      [
        "name"          => "Technical Support",
      ],
      [
        "name"          => "Manager",
      ],
      [
        "name"          => "Supervisor",
      ],
      [
        "name"          => "Team Leader",
      ],
      [
        "name"          => "Agent",
      ],
      [
        "name"          => "Sales Representative",
      ],
      [
        "name"          => "Dealer",
      ],

    ];
  
    foreach ($roles as $role) {
      Role::create($role);
    }
  }
}
