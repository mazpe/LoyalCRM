<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDealersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dealers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('dealer_group_id')->unsigned()->nullable()->index('dealers_dealer_group_id_foreign');
			$table->integer('manufacture_id')->unsigned()->nullable()->index('dealers_manufacture_id_foreign');
			$table->integer('agent_id')->unsigned()->nullable()->index('dealers_agent_id_foreign');
			$table->string('name')->unique();
			$table->string('address_1')->nullable();
			$table->string('address_2')->nullable();
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->string('zip')->nullable();
			$table->string('full_address')->nullable();
			$table->string('phone')->nullable();
			$table->string('fax')->nullable();
			$table->string('email')->nullable();
			$table->string('website')->nullable();
			$table->string('owner')->nullable();
			$table->string('owner_phone')->nullable();
			$table->string('owner_email')->nullable();
			$table->string('general_manager')->nullable();
			$table->string('general_manager_phone')->nullable();
			$table->string('general_manager_email')->nullable();
			$table->string('sales_manager')->nullable();
			$table->string('sales_manager_phone')->nullable();
			$table->string('sales_manager_email')->nullable();
			$table->string('service_manager')->nullable();
			$table->string('service_manager_phone')->nullable();
			$table->string('service_manager_email')->nullable();
			$table->dateTime('last_contact_date')->nullable();
			$table->integer('last_contact_type_id')->unsigned()->nullable();
			$table->boolean('last_call')->nullable();
			$table->dateTime('next_contact_date')->nullable();
			$table->integer('next_contact_type_id')->unsigned()->nullable()->index('next_contact_type_id');
			$table->string('last_contact_note')->nullable();
			$table->integer('stage_id')->unsigned()->nullable()->default(9)->index('stage');
			$table->string('next_contact_note')->nullable();
			$table->string('note')->nullable();
			$table->integer('added_by_id')->unsigned()->index('dealers_added_by_id_foreign');
			$table->integer('updated_by_id')->unsigned()->nullable()->index('updated_by');
			$table->boolean('active')->default(1);
			$table->timestamps();
			$table->index(['last_contact_type_id','next_contact_type_id'], 'last_contact_type_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('dealers');
	}

}
