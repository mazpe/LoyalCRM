<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAppointmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('appointments', function(Blueprint $table)
		{
			$table->increments('id');
            $table->unsignedInteger('deal_id');
            $table->dateTime('appointment_date')->nullable();
            $table->unsignedInteger('added_by_id');
            $table->boolean('active')->default('1');
			$table->timestamps();

            $table->foreign('deal_id')
                ->references('id')
                ->on('deals')
                ->onDelete('restrict')
                ->onUpdate('cascade');
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
		Schema::drop('appointments');
	}

}
