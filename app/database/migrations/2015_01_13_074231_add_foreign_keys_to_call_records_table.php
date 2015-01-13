<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCallRecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('call_records', function(Blueprint $table)
		{
			$table->foreign('agent_id', 'call_records_ibfk_1')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('dealer_id', 'call_records_ibfk_2')->references('id')->on('dealers')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('call_records', function(Blueprint $table)
		{
			$table->dropForeign('call_records_ibfk_1');
			$table->dropForeign('call_records_ibfk_2');
		});
	}

}
