<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('branches', function(Blueprint $table) {
			$table->foreign('business_type_id')->references('id')->on('business_types')
						->onDelete('restrict')
						->onUpdate('restrict');
			$table->foreign('entryby')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		
		Schema::table('legal_docs', function(Blueprint $table) {
			$table->foreign('branch_id')->references('id')->on('branches')
						->onDelete('restrict')
						->onUpdate('restrict');
			$table->foreign('entryby')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('departments', function(Blueprint $table) {
			$table->foreign('branch_id')->references('id')->on('branches')
						->onDelete('restrict')
						->onUpdate('restrict');
			$table->foreign('entryby')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('staffs', function(Blueprint $table) {
			$table->foreign('position_id')->references('id')->on('positions')
						->onDelete('restrict')
						->onUpdate('restrict');
			$table->foreign('entryby')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('staffs', function(Blueprint $table) {
			$table->foreign('department_id')->references('id')->on('departments')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('staffs', function(Blueprint $table) {
			$table->foreign('branch_id')->references('id')->on('branches')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('bank_transactions', function(Blueprint $table) {
			$table->foreign('bank_id')->references('id')->on('Banks')
						->onDelete('restrict')
						->onUpdate('restrict');
			$table->foreign('entryby')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('daily_expense', function(Blueprint $table) {
			$table->foreign('expense_category_id')->references('id')->on('expense_categories')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('daily_expense', function(Blueprint $table) {
			$table->foreign('entryby')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('requisitions', function(Blueprint $table) {
			$table->foreign('department_id')->references('id')->on('departments')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('requisitions', function(Blueprint $table) {
			$table->foreign('req_by')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('requisitions', function(Blueprint $table) {
			$table->foreign('item_id')->references('id')->on('items')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('payrolls', function(Blueprint $table) {
			$table->foreign('staff_id')->references('id')->on('staffs')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('payrolls', function(Blueprint $table) {
			$table->foreign('position_id')->references('id')->on('positions')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('payrolls', function(Blueprint $table) {
			$table->foreign('allowance_id')->references('id')->on('allowances')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('payrolls', function(Blueprint $table) {
			$table->foreign('deduction_id')->references('id')->on('deductions')
						->onDelete('restrict')
						->onUpdate('restrict');
			$table->foreign('entryby')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('asset_depreciations', function(Blueprint $table) {
			$table->foreign('asset_id')->references('id')->on('assets')
						->onDelete('restrict')
						->onUpdate('restrict');
			$table->foreign('entryby')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');			
		});
		Schema::table('asset_additional_expenses', function(Blueprint $table) {
			$table->foreign('asset_id')->references('id')->on('assets')
						->onDelete('restrict')
						->onUpdate('restrict');
			$table->foreign('entryby')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');			
		});
	}

	public function down()
	{
		
		Schema::table('legal_docs', function(Blueprint $table) {
			$table->dropForeign('legal_docs_branch_id_foreign');
		});
		Schema::table('departments', function(Blueprint $table) {
			$table->dropForeign('departments_branch_id_foreign');
		});
		Schema::table('staffs', function(Blueprint $table) {
			$table->dropForeign('staffs_position_id_foreign');
		});
		Schema::table('staffs', function(Blueprint $table) {
			$table->dropForeign('staffs_department_id_foreign');
		});
		Schema::table('staffs', function(Blueprint $table) {
			$table->dropForeign('staffs_branch_id_foreign');
		});
		Schema::table('bank_transactions', function(Blueprint $table) {
			$table->dropForeign('bank_transactions_bank_id_foreign');
		});
		Schema::table('daily_expense', function(Blueprint $table) {
			$table->dropForeign('daily_expense_expense_category_id_foreign');
		});
		Schema::table('daily_expense', function(Blueprint $table) {
			$table->dropForeign('daily_expense_entryby_foreign');
		});
		Schema::table('requisitions', function(Blueprint $table) {
			$table->dropForeign('requisitions_department_id_foreign');
		});
		Schema::table('requisitions', function(Blueprint $table) {
			$table->dropForeign('requisitions_req_by_foreign');
		});
		Schema::table('requisitions', function(Blueprint $table) {
			$table->dropForeign('requisitions_item_id_foreign');
		});
		Schema::table('payrolls', function(Blueprint $table) {
			$table->dropForeign('payrolls_staff_id_foreign');
		});
		Schema::table('payrolls', function(Blueprint $table) {
			$table->dropForeign('payrolls_position_id_foreign');
		});
		Schema::table('payrolls', function(Blueprint $table) {
			$table->dropForeign('payrolls_allowance_id_foreign');
		});
		Schema::table('payrolls', function(Blueprint $table) {
			$table->dropForeign('payrolls_deduction_id_foreign');
		});
		Schema::table('asset_depreciations', function(Blueprint $table) {
			$table->dropForeign('asset_depreciations_asset_id_foreign');
		});
		Schema::table('asset_additional_expenses', function(Blueprint $table) {
			$table->dropForeign('asset_additional_expenses_asset_id_foreign');
		});
	}
}