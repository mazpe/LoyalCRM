<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDealerGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dealer_groups', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique();
			$table->string('address_1')->nullable();
			$table->string('address_2')->nullable();
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->string('zip')->nullable();
			$table->string('phone')->nullable();
			$table->string('fax')->nullable();
			$table->string('email')->nullable();
			$table->string('contact')->nullable();
			$table->string('contact_phone')->nullable();
			$table->string('contact_email')->nullable();
			$table->integer('added_by_id')->unsigned()->index('dealer_groups_added_by_id_foreign');
			$table->boolean('active')->default(1);
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
		Schema::drop('dealer_groups');
	}

}
