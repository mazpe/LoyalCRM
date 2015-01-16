<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateManufacturesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('manufactures', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique();
			$table->integer('added_by_id')->unsigned()->index('manufactures_added_by_id_foreign');
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
		Schema::drop('manufactures');
	}

}
