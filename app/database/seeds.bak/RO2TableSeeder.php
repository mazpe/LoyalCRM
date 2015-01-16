<?php

class RO2TableSeeder
  extends DatabaseSeeder
{
  public function run()
  {

    $faker = Faker\Factory::create();

    $models = array("Corolla", "Camry", "Yaris", "Avalon", 
        "Sienna", "Tacoma","Tundra","Rav4","4Runner","Venza",
        "Highlander","Sequoia");

    $vin = array("1HGES26712L272768","2B4GP25G01R869407","1G4CU5211Y4865385",
        "5TBET381X5S311590","1GCEC19038Z681512","1N6MD26Y21C043282",
        "KNDJA7230X5326203","WVWDU93C16P011069","1HGCM723X4A557954",
        "4T1BF1FK2EU305047","4T1BF1FK2EU742644","4T1BF1FK5EU312753",
        "4T1BF1FK9EU730930","5TDKK3DC0ES445075","5TDYK3DC9ES407340",
        "4T1BK1EB9EU088626","2T1BURHE1EC063722","2T1BURHE2EC066645",
        "5YFBURHE2EP066032","5YFBURHE7EP002892","3TMLU4EN0EM146402",
        "3TMLU4EN6EM137137","3TMMU4FN3EM063288","5TFTX4CN2EX037962",
        "5TFUU4EN7EX088531","5TFDW5F18EX357437","VNKKTUD37EA001991",
        "1B3AJ46U41N314842","1N6BA0CH3BN663864","1D3HW58N26S129344",
        "1GCHK23183F059926","1GCJK34D16E439197","2FAHP72V47X005901",
        "2TBET381X5S31S590","1G1234DFDDDGR1512","1N2II2LY21C123281",
        "1NDJA7230X5326323","WASDFS2C16AEF1069","2O8DML23X4A551954",
        "7T1BF1FK2EU30WE47","4T342TGT5SHT42644","4T1BF1FK5EU312753",
        "4DCBFDF434U7309C0","5T23RSDC0ES44SDF5","1T2KE9D4GES405340",
        "4T1B32EB9ESDS8C56","2T1SFFHE1E30RFSS2","2T1122HE2E2262645",
        "5YFSDFSE2EP066033","2DDFEEDE7EP0028DF","3TML123123M113401",
        "12MLU4CSSSA137137","ETMMU4FWEFW35T288","13FTTH665EX037222",
        "5TDSDFWNERX088331","5TFDW5F1J383K3431","VNKR12321EA011211",
        "1B33322U41N314842","WWSE44553BN663864","1DWERW23262129241",
        "1GXHK23183F05AWER","1G212EKL383K39197","2F2344RF47X005111",
    );

    $i = 10;

    foreach(range(1,60) as $index) {
        $firstName = $faker->firstName;
        $lastName  = $faker->lastName;
        $fullName  = $firstName ." ". $lastName;
        $email     = $firstName .".". $lastName ."@".$faker->freeEmailDomain;
    
       RepairOrder::create([
        "dealer_id"     => "1",
        "number"        => "10". $i,
        "date"          =>  $faker->dateTimeBetween('-3 month', 'now')
                                  ->format('Y-m-d'),
        "status"        => "Closed",
        "vehicle_vin"   => $vin[array_rand($vin,1)],    
        "amount"        => rand(150,300).".".rand(1,9)."".rand(1,9),
        "added_by_id"   => "1",
      ]);

      $i++;
    }

  }
}
