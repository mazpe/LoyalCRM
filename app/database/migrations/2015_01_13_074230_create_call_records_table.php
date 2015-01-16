<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCallRecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('call_records', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('agent_id')->unsigned()->index('call_records_agent_id_foreign');
			$table->integer('dealer_id')->unsigned()->index('call_records_dealer_id_foreign');
			$table->dateTime('last_contact_date')->nullable();
			$table->integer('last_contact_type_id')->nullable()->index('last_contact_type_id_2');
			$table->text('last_contact_note', 65535)->nullable();
			$table->boolean('last_call')->nullable();
			$table->integer('stage_id')->nullable()->index('stage_id');
            $table->integer('added_by_id')->unsigned()->index('call_records_added_by_foreing');
            //$table->foreign('added_by_id')->references('id')->on('users');
			$table->timestamps();
			$table->index(['last_contact_type_id','stage_id'], 'last_contact_type_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('call_records');
	}

}
