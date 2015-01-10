<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
			//
            $table->increments('id');
            $table->string('name')->unique();
            $table->unsignedInteger('added_by_id');
            $table->boolean('active')->default('1');
            $table->timestamps();

            $table->foreign('added_by_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');


		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('manufactures', function(Blueprint $table)
		{
			//
		});
	}

}
