<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('campaigns', function(Blueprint $table)
		{
			//
            $table->increments('id');
            $table->foreign('dealer_id')
                ->references('id')
                ->on('dealers')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->string('name');
            $table->foreign('added_by_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->boolean('active')->default('1');
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
		Schema::table('campaigns', function(Blueprint $table)
		{
			//
		});
	}

}
