<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('assignments', function(Blueprint $table)
		{

            $table->increments('id');
            $table->foreign('deal_id')
                ->references('id')
                ->on('deals')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('campaign_id')
                ->references('id')
                ->on('campaigns')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('assigned_to_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade')->nullable();
            $table->foreign('assigned_by_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade')->nullable();
            $table->dateTime('assigned_date')->nulltable();
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
		Schema::table('assignments', function(Blueprint $table)
		{
			//
		});
	}

}
