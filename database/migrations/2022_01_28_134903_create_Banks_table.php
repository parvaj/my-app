<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBanksTable extends Migration {

	public function up()
	{
		Schema::create('Banks', function(Blueprint $table) {
			$table->increments('id');
			
			$table->string('b_name', 100);
			$table->string('branch_name', 100);
			$table->string('account_no', 50);
			$table->string('account_type', 50);
			$table->string('routing_no', 100);
			$table->decimal('opening_balance', 10,2);
			$table->string('short_code', 50);

            $table->tinyInteger('active')->default(0);
            $table->string('status', 255)->default('created');
            $table->string('comment', 255)->nullable();
            $table->string('api_ver', 8)->nullable();
            $table->string('app_ver', 8)->nullable();
            $table->string('u_agent', 255)->nullable();

			$table->timestamps();
			$table->softDeletes();
			$table->integer('entryby')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('Banks');
	}
}