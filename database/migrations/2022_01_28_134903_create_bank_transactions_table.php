<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBankTransactionsTable extends Migration {

	public function up()
	{
		Schema::create('bank_transactions', function(Blueprint $table) {
			$table->increments('id');
			
			$table->decimal('amount');
			$table->integer('bank_id')->unsigned();
			$table->date('t_date');
			$table->string('type');
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
		Schema::drop('bank_transactions');
	}
}