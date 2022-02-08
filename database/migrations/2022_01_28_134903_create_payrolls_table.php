<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePayrollsTable extends Migration {

	public function up()
	{
		Schema::create('payrolls', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('staff_id')->unsigned();
			$table->integer('position_id')->unsigned();
			$table->date('pay_period');
			$table->decimal('basic', 8,2);
			$table->integer('allowance_id')->unsigned();
			$table->date('pay_date');
			$table->decimal('net_pay', 8,2);
			$table->decimal('bonus', 8,2);
			$table->integer('deduction_id')->unsigned();

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
		Schema::drop('payrolls');
	}
}