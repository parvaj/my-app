<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequisitionsTable extends Migration {

	public function up()
	{
		Schema::create('requisitions', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('department_id')->unsigned();
			$table->integer('req_by')->unsigned();
			$table->date('req_date');
			$table->integer('item_id')->unsigned();
			$table->integer('qty');
			$table->tinyInteger('is_approved');
			$table->integer('supplier_id')->unsigned();

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
		Schema::drop('requisitions');
	}
}