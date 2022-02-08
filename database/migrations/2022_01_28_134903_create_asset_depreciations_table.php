<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssetDepreciationsTable extends Migration {

	public function up()
	{
		Schema::create('asset_depreciations', function(Blueprint $table) {
			$table->increments('id');
			
			$table->integer('depreciation_year');
			$table->integer('asset_id')->unsigned();
			$table->integer('asset_qty');
			$table->double('current_value', 8,2);
			$table->double('additional_value', 8,2);
			$table->double('sale_value', 8,2);
			$table->double('balance_before_depreciation', 8,2);
			$table->double('depreciation_rate', 8,2);
			$table->double('depreciation', 8,2);
			$table->double('balance_after_depreciation', 8,2);
			$table->date('entry_date');

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
		Schema::drop('asset_depreciations');
	}
}