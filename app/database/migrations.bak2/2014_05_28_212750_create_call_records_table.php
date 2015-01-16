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
		Schema::create('call_records', function(Blueprint $table)
		{
            $table->increments('id');
            $table->unsignedInteger('agent_id');
            $table->unsignedInteger('deal_id');
            $table->unsignedInteger('disposition_id');
            $table->dateTime('started')->nullable();
            $table->dateTime('stopped')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('agent_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('deal_id')
                ->references('id')
                ->on('deals')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('disposition_id')
                ->references('id')
                ->on('dispositions')
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
		Schema::table('call_records', function(Blueprint $table)
		{
			//
		});
	}

}
