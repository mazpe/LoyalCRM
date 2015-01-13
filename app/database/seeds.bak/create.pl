#!/usr/bin/perl -w

use strict;

#my @chars = ('1','2','3');
#my $string = join '', map { @chars[rand @chars] } 1 ;
#print $string;

my $x = 10;

for (my $i=0; $i <= 100; $i++) {

    my @dealers_list = ("3","13","14");
    my $dealer = $dealers_list[rand @dealers_list];

    my @models_list = ("Corolla", "Camry", "Yaris", "Avalon", 
        "Sienna", "Tacoma");
    my $model = $models_list[rand @models_list];

    my @dates_list = ("2014-3-1","2014-1-1", "2013-10-1");
    my $date = $dates_list[rand @dates_list];

    my $deal = deal_generator($dealer,$x,$model,$date);
    $x++;

    print $deal;
}

sub deal_generator {
    my ($dealer, $number, $model, $date) = @_;

my $var = qq|
      [
        "dealer_id"         => "$dealer",
        "customer_number"   => "10$number",
        "deal_number"       => "20$number",
        "name"              => "Client $number",
        "address_1"         => "Address 1",
        "address_2"         => "Address 2",
        "city"              => "City",
        "state"             => "State",
        "zip"               => "Zip",
        "phone"             => "305-255-55$number",
        "fax"               => "",
        "email"             => "client$number\@email.com",
        "stock_number"      => "30$number",
        "vehicle_year"      => "2013",
        "vehicle_make"      => "Toyota",
        "vehicle_model"     => "$model",
        "vehicle_color"     => "Black",
        "purchase_date"     => "$date",
        "last_visit"        => "",
      ],\n
|;

return $var;

}

