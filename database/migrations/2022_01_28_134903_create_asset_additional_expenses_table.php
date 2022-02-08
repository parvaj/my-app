<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssetAdditionalExpensesTable extends Migration {

	public function up()
	{
		Schema::create('asset_additional_expenses', function(Blueprint $table) {
			$table->increments('id');
			
			$table->integer('asset_id')->unsigned();
			$table->date('expenses_date');
			$table->string('expenses_description', 100);
			$table->double('expenses_amount', 8,2);
			$table->double('sale_amount', 8,2);
			$table->date('entry_date');
			$table->string('approve_by', 50);
			$table->date('approve_date');
			
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
		Schema::drop('asset_additional_expenses');
	}
}