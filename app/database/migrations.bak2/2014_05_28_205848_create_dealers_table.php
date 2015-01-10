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
		Schema::create('dealers', function(Blueprint $table)
		{
            $table->increments('id');
            $table->unsignedInteger('dealer_group_id');
            $table->unsignedInteger('manufacture_id');
            $table->string('name')->unique();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('contact')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->unsignedInteger('added_by_id');
            $table->boolean('active')->default('1');
            $table->timestamps();

            $table->foreign('dealer_group_id')
                ->references('id')
                ->on('dealer_groups')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('manufacture_id')
                ->references('id')
                ->on('manufactures')
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
		Schema::table('dealers', function(Blueprint $table)
		{
			//
		});
	}

}
