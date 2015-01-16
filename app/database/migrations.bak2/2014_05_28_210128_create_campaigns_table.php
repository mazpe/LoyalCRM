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
		Schema::create('campaigns', function(Blueprint $table)
		{
			//
            $table->increments('id');
            $table->unsignedInteger('dealer_id');
            $table->string('name');
            $table->unsignedInteger('added_by_id');
            $table->boolean('active')->default('1');
            $table->timestamps();

            $table->foreign('dealer_id')
                ->references('id')
                ->on('dealers')
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
		Schema::table('campaigns', function(Blueprint $table)
		{
			//
		});
	}

}
