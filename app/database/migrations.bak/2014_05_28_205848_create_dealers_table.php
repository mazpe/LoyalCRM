<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('dealers', function(Blueprint $table)
		{
            $table->increments('id');
            $table->foreign('group_id')
                ->references('id')
                ->on('dealer_groups')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('manufacture_id')
                ->references('id')
                ->on('manufactures')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->string('name')->unique();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('phone';)->nullable();
            $table->string('fax';)->nullable();
            $table->string('email';)->nullable();
            $table->string('contact';)->nullable();
            $table->string('contact_phone';)->nullable();
            $table->string('contact_email';)->nullable();
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
		Schema::table('dealers', function(Blueprint $table)
		{
			//
		});
	}

}
