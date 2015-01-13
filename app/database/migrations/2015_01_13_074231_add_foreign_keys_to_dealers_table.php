<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDealersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('dealers', function(Blueprint $table)
		{
			$table->foreign('dealer_group_id', 'dealers_ibfk_1')->references('id')->on('dealer_groups')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('manufacture_id', 'dealers_ibfk_2')->references('id')->on('manufactures')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('agent_id', 'dealers_ibfk_3')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('last_contact_type_id', 'dealers_ibfk_4')->references('id')->on('contact_types')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('added_by_id', 'dealers_ibfk_6')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('next_contact_type_id', 'dealers_ibfk_7')->references('id')->on('contact_types')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('stage_id', 'dealers_ibfk_8')->references('id')->on('stages')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('updated_by_id', 'dealers_ibfk_9')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('dealers', function(Blueprint $table)
		{
			$table->dropForeign('dealers_ibfk_1');
			$table->dropForeign('dealers_ibfk_2');
			$table->dropForeign('dealers_ibfk_3');
			$table->dropForeign('dealers_ibfk_4');
			$table->dropForeign('dealers_ibfk_6');
			$table->dropForeign('dealers_ibfk_7');
			$table->dropForeign('dealers_ibfk_8');
			$table->dropForeign('dealers_ibfk_9');
		});
	}

}
