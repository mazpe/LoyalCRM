<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallRecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('call_records', function(Blueprint $table)
		{
            $table->increments('id');
            $table->foreign('agent_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('dealer_id')
                ->references('id')
                ->on('dealers')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->dateTime('started');
            $table->dateTime('stopped');
            $table->string('resolution');
            $table->text('notes')->nullable();
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
		Schema::table('call_records', function(Blueprint $table)
		{
			//
		});
	}

}
