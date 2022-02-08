<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBranchesTable extends Migration {

	public function up()
	{
		Schema::create('branches', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 150);
			$table->string('details', 200)->nullable();
			$table->string('address', 150)->nullable();
			$table->integer('business_type_id')->unsigned()->default(0);
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
		Schema::drop('branches');
	}
}