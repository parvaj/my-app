<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStaffsTable extends Migration {

	public function up()
	{
		Schema::create('staffs', function(Blueprint $table) {
			$table->increments('id');
			$table->string('first_name', 100)->default('NULL');
			$table->string('last_name', 100)->default('NULL');
			$table->date('joining_date')->default('NULL');
			$table->integer('position_id')->unsigned();
			$table->date('birth_date')->default('NULL');
			$table->string('photo', 50)->default('NULL');
			$table->integer('department_id')->unsigned();
			$table->string('nid', 50)->default('NULL');
			$table->string('acc_no', 50)->default('NULL');
			$table->integer('salary')->default('0');
			$table->integer('branch_id')->unsigned();
			$table->enum('gender', array('0', '1'));
			
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
		Schema::drop('staffs');
	}
}