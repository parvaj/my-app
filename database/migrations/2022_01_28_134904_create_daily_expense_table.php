<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDailyExpenseTable extends Migration {

	public function up()
	{
		Schema::create('daily_expense', function(Blueprint $table) {
			$table->increments('id');
			$table->date('expense_date');
			$table->integer('expense_category_id')->unsigned();
			$table->decimal('amount', 8,2);
			$table->string('note', 100);
			
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
		Schema::drop('daily_expense');
	}
}