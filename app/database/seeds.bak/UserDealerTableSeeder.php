<?php
 
class UserDealerTableSeeder
  extends DatabaseSeeder
{
  public function run()
  {
    $users = [
      [
        "name"          => "Hialeah Toyota Login",
        "username"      => "htoyota",
        "password"      => Hash::make('password'),
        "phone"         => "000-000-0000",
        "email"         => "htoyota@loyaldriver.com",
        "dealer_id"     => 1,
      ],



    ];
  
    foreach ($users as $user) {
      User::create($user);
    }
  }
}
