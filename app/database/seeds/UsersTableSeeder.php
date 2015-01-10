<?php
 
class UsersTableSeeder
  extends DatabaseSeeder
{
  public function run()
  {
    $users = [
      [
        "name"          => "Lester Mesa",
        "username"      => "lester",
        "password"      => Hash::make('password'),
        "phone"         => "786-342-3433",
        "email"         => "lester@loyaldriver.com",
      ],
      [
        "name"          => "Nick DiNapoli",
        "username"      => "nick",
        "password"      => Hash::make('password'),
        "phone"         => "954-232-3433",
        "email"         => "nick@loyaldriver.com",
      ],
      [ 
        "name"          => "Alex Bezianis",
        "username"      => "alex",
        "password"      => Hash::make('password'),
        "phone"         => "954-345-3246",
        "email"         => "alex@loyaldriver.com",
      ],
      [
        "name"          => "Manager",
        "username"      => "manager",
        "password"      => Hash::make('password'),
        "phone"         => "000-000-0000",
        "email"         => "manager@loyaldriver.com",
      ],
      [
        "name"          => "Agent 1",
        "username"      => "agent1",
        "password"      => Hash::make('password'),
        "phone"         => "000-000-0000",
        "email"         => "agent1@loyaldriver.com",
      ],
      [
        "name"          => "Agent 2",
        "username"      => "agent2",
        "password"      => Hash::make('password'),
        "phone"         => "000-000-0000",
        "email"         => "agent2@loyaldriver.com",
      ],
      [
        "name"          => "Sales Representative",
        "username"      => "sales",
        "password"      => Hash::make('password'),
        "phone"         => "000-000-0000",
        "email"         => "sales@loyaldriver.com",
      ],

    ];
  
    foreach ($users as $user) {
      User::create($user);
    }
  }
}
