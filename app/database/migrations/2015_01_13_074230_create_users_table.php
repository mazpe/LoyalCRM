<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('dealer_id')->unsigned()->nullable()->index('users_dealer_id_foreign');
			$table->string('name');
			$table->string('initials', 32)->nullable();
			$table->string('username');
			$table->string('password');
			$table->string('email');
			$table->string('address_1')->nullable();
			$table->string('address_2')->nullable();
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->string('zip')->nullable();
			$table->string('phone')->nullable();
			$table->string('fax')->nullable();
			$table->string('remember_token')->nullable();
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
		Schema::drop('users');
	}

}
