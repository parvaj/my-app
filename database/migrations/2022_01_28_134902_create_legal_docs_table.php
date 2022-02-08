<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLegalDocsTable extends Migration {

	public function up()
	{
		Schema::create('legal_docs', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 150);
			$table->integer('branch_id')->unsigned();
			$table->string('file_name', 100);

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
		Schema::drop('legal_docs');
	}
}