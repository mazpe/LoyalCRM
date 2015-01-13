<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Rev2 extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			//
            $table->increments("id");
            $table->string('name');
            $table->string("username");
            $table->string("password");
            $table->string("email");
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string("remember_token")->nullable();
            $table->boolean('active')->default('1');
            $table->timestamps();
		});

		Schema::create('roles', function(Blueprint $table)
		{
			//
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
		});

        Schema::create('assigned_roles', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users'); // assumes a users table
            $table->foreign('role_id')->references('id')->on('roles');
            $table->timestamps();
        });

        // Creates the permissions table
        Schema::create('permissions', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('display_name');
            $table->timestamps();
        });

        // Creates the permission_role (Many-to-Many relation) table
        Schema::create('permission_role', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->foreign('permission_id')->references('id')->on('permissions'); // assumes a users table
            $table->foreign('role_id')->references('id')->on('roles');
            $table->timestamps();
        });

        Schema::create('token', function(Blueprint $table)
        {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
        });

	    Schema::create('manufactures', function(Blueprint $table)
		{
			//
            $table->increments('id');
            $table->string('name')->unique();
            $table->unsignedInteger('added_by_id');
            $table->boolean('active')->default('1');
            $table->timestamps();

            $table->foreign('added_by_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

		});

		Schema::create('dealer_groups', function(Blueprint $table)
		{
			//
            $table->increments('id');
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

            $table->foreign('added_by_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
		});
		
	    Schema::create('dealers', function(Blueprint $table)
		{
            $table->increments('id');
            $table->unsignedInteger('dealer_group_id');
            $table->unsignedInteger('manufacture_id');
            $table->unsignedInteger('agent_id')->nullable();
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
            $table->string('service_phone')->nullable();
            $table->string('hours_of_operation')->nullable();
            $table->string('default_rate')->nullable();
            $table->string('default_records')->nullable();
            $table->string('appt_recipients')->nullable();
            $table->unsignedInteger('added_by_id');
            $table->boolean('active')->default('1');
            $table->timestamps();

            $table->foreign('dealer_group_id')->references('id')->on('dealer_groups')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('manufacture_id')->references('id')->on('manufactures')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('agent_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('added_by_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

		});

        Schema::table('users', function(Blueprint $table)
        {
            $table->unsignedInteger('dealer_id')->after('id')->nullable();

            $table->foreign('dealer_id')->references('id')->on('dealers')->onDelete('restrict')->onUpdate('cascade');
        });

        Schema::create('campaigns', function(Blueprint $table)
        {
            //
            $table->increments('id');
            $table->unsignedInteger('dealer_id');
            $table->string('name');
            $table->unsignedInteger('added_by_id');
            $table->boolean('active')->default('1');
            $table->timestamps();

            $table->foreign('dealer_id')->references('id')->on('dealers')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('added_by_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
        });

        Schema::create('dispositions', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name')->unique();
            $table->unsignedInteger('added_by_id');
            $table->boolean('active')->default('1');
            $table->timestamps();
        });

        Schema::create('months', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('number');
            $table->unsignedInteger('added_by_id');
            $table->boolean('active')->default('1');
            $table->timestamps();
            $table->foreign('added_by_id')->references('id')->on('users')
                ->onDelete('restrict')->onUpdate('cascade')
            ;
        });

        Schema::create('dealers_months', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('dealer_id');
            $table->unsignedInteger('month_id');
            $table->string('rate');
            $table->string('records');
            $table->text('note')->nullable();
            $table->unsignedInteger('added_by_id');
            $table->timestamps();

            $table->foreign('month_id')->references('id')->on('months')
                ->onDelete('restrict')->onUpdate('cascade')
            ;
            $table->foreign('dealer_id')->references('id')->on('dealers')
                ->onDelete('restrict')->onUpdate('cascade')
            ;
            $table->foreign('added_by_id')->references('id')->on('users')
                ->onDelete('restrict')->onUpdate('cascade')
            ;
        });

		Schema::create('deals', function(Blueprint $table)
		{
			//
            $table->increments('id');
            $table->unsignedInteger('dealer_id');
            $table->unsignedInteger('campaign_id')->nullable();
            $table->unsignedInteger('month_id')->nullable();
            $table->unsignedInteger('agent_id')->nullable();
            $table->string('customer_number')->nullable();
            $table->string('deal_number');
            $table->string('name');
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('confirmation_email')->nullable();
            $table->string('stock_number')->nullable();
            $table->string('vehicle_vin')->nullable();
            $table->string('vehicle_year')->nullable();
            $table->string('vehicle_make')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->string('vehicle_color')->nullable();
            $table->integer('vehicle_mileage')->nullable();
            $table->date('purchase_date')->nullable();
            $table->unsignedInteger('disposition_id')->nullable();
            $table->date('last_visit')->nullable();
            $table->dateTime('last_called')->nullable();
            $table->dateTime('appointment')->nullable();
            $table->text('note')->nullable();
            $table->boolean('active')->default('1');
            $table->timestamps();

            $table->foreign('dealer_id')->references('id')->on('dealers')
                ->onDelete('restrict')->onUpdate('cascade')
            ;
            $table->foreign('campaign_id')->references('id')->on('campaigns')
                ->onDelete('restrict')->onUpdate('cascade')
            ;
            $table->foreign('disposition_id')
                ->references('id')->on('dispositions')->onDelete('restrict')
                ->onUpdate('cascade')
            ;
            $table->foreign('agent_id')->references('id')->on('users')
                ->onDelete('restrict')->onUpdate('cascade')
            ;
            $table->foreign('month_id')->references('id')->on('months')
                ->onDelete('restrict')->onUpdate('cascade')
            ;

		});

		Schema::create('assignments', function(Blueprint $table)
		{

            $table->increments('id');
            $table->unsignedInteger('deal_id');
            $table->unsignedInteger('campaign_id');
            $table->unsignedInteger('assigned_to_id')->nullable();
            $table->unsignedInteger('assigned_by_id')->nullable();
            $table->dateTime('assigned_date')->nulltable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('deal_id')->references('id')->on('deals')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('restrict')->onUpdate('cascade');            
            $table->foreign('assigned_to_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('assigned_by_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
		});

		Schema::create('call_records', function(Blueprint $table)
		{
            $table->increments('id');
            $table->unsignedInteger('agent_id');
            $table->unsignedInteger('deal_id');
            $table->unsignedInteger('dealer_id');
            $table->unsignedInteger('disposition_id');
            $table->dateTime('started')->nullable();
            $table->dateTime('stopped')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('agent_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('deal_id')->references('id')->on('deals')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('dealer_id')->references('id')->on('dealers')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('disposition_id')->references('id')->on('dispositions')->onDelete('restrict')->onUpdate('cascade');
		});

		Schema::create('appointments', function(Blueprint $table)
		{
			$table->increments('id');
            $table->unsignedInteger('deal_id');
            $table->dateTime('appointment')->nullable();
            $table->unsignedInteger('added_by_id');
            $table->boolean('active')->default('1');
			$table->timestamps();

            $table->foreign('deal_id')->references('id')->on('deals')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('added_by_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

		});

        Schema::create('repair_orders', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('dealer_id');
            $table->string('name');
            $table->string('number');
            $table->dateTime('date')->nullable();
            $table->string('status')->nullable();
            $table->string('amount')->nullable();
            $table->string('vehicle_vin')->nullable();
            $table->string('mileage')->nullable();
            $table->unsignedInteger('added_by_id');
            $table->boolean('active')->default('1');
            $table->timestamps();
            $table->foreign('dealer_id')->references('id')->on('dealers')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('added_by_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
        });

	}

	public function down() {
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('assigned_roles');
        Schema::dropIfExists('assigments');
        Schema::dropIfExists('call_records');
        Schema::dropIfExists('campaigns');
        Schema::dropIfExists('dealers');
        Schema::dropIfExists('dealer_groups');
        Schema::dropIfExists('deals');
        Schema::dropIfExists('dispositions');
        Schema::dropIfExists('manufactures');
        Schema::dropIfExists('migrations');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('repair_orders');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('token');
        Schema::dropIfExists('users');
    }
}
