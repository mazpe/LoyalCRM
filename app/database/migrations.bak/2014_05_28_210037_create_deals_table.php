<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('deals', function(Blueprint $table)
		{
			//
            $table->increments('id');
            $table->foreign('dealer_id')
                ->references('id')
                ->on('dealers')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->string('customer_number')->nullable();
            $table->string('deal_number');
            $table->string('name');
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();

            $table->string('stock_number')->nullable();
            $table->string('vehicle_year')->nullable();
            $table->string('vehicle_make')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->string('vehicle_color')->nullable();
            $table->dateTime('purchase_date')->nullable();
            $table->dateTime('first_call')->nullable();
            $table->string('first_call_results')->nullable();
            $table->dateTime('second_call')->nullable();
            $table->string('second_call_results')->nullable();
            $table->dateTime('third_call')->nullable();
            $table->string('third_call_results')->nullable();
            $table->string('final_results')->nullable();
            $table->dateTime('last_visit')->nullable();


            $table->boolean('active')->default('1');
            $table->timestamps();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('deals', function(Blueprint $table)
		{
			//
		});
	}

}
