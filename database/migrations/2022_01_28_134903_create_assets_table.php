<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssetsTable extends Migration {

	public function up()
	{
		Schema::create('assets', function(Blueprint $table) {
			$table->increments('id');
			
			$table->string('asset_type', 50);
			$table->string('asset_name', 50);
			$table->integer('asset_qty');
			$table->date('purchase_date');
			$table->decimal('purchase_value', 8,2);
			$table->decimal('current_value', 8,2);
			$table->decimal('depreciation_rate', 8,2);
			$table->date('entry_date');
			$table->string('approve_by', 100);
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
		Schema::drop('assets');
	}
}