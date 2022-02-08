<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('expensecategory','App\Http\Controllers\ExpenseCategoryController@index');
Route::post('expensecategory/create','App\Http\Controllers\ExpenseCategoryController@create');
Route::delete('expensecategory/delete/{id}','App\Http\Controllers\ExpenseCategoryController@destroy');
Route::put('expensecategory/update/{id}','App\Http\Controllers\ExpenseCategoryController@update');


Route::get('dailyexpense','App\Http\Controllers\DailyExpenseController@index');
Route::post('stadailyexpenseff/create','App\Http\Controllers\DailyExpenseController@create');
Route::delete('dailyexpense/delete/{id}','App\Http\Controllers\DailyExpenseController@destroy');
Route::put('dailyexpense/update/{id}','App\Http\Controllers\DailyExpenseController@update');


Route::get('staff','App\Http\Controllers\StaffController@index');
Route::post('staff/create','App\Http\Controllers\StaffController@create');
Route::delete('staff/delete/{id}','App\Http\Controllers\StaffController@destroy');
Route::put('staff/update/{id}','App\Http\Controllers\StaffController@update');


Route::get('bank','App\Http\Controllers\BankController@index');
Route::post('bank/create','App\Http\Controllers\BankController@create');
Route::delete('bank/delete/{id}','App\Http\Controllers\BankController@destroy');
Route::put('bank/update/{id}','App\Http\Controllers\BankController@update');

Route::get('transaction','App\Http\Controllers\TransactionController@index');
Route::post('transaction/create','App\Http\Controllers\TransactionController@create');
Route::delete('transaction/delete/{id}','App\Http\Controllers\TransactionController@destroy');
Route::put('transaction/update/{id}','App\Http\Controllers\TransactionController@update');


Route::get('position','App\Http\Controllers\PositionController@index');
Route::post('position/create','App\Http\Controllers\PositionController@create');
Route::delete('position/delete/{id}','App\Http\Controllers\PositionController@destroy');
Route::put('position/update/{id}','App\Http\Controllers\PositionController@update');


Route::get('department','App\Http\Controllers\DepartmentController@index');
Route::post('department/create','App\Http\Controllers\DepartmentController@create');
Route::delete('department/delete/{id}','App\Http\Controllers\DepartmentController@destroy');
Route::put('department/update/{id}','App\Http\Controllers\DepartmentController@update');

Route::get('category','App\Http\Controllers\BusinessTypeController@index');
Route::post('category/create','App\Http\Controllers\BusinessTypeController@create');
Route::delete('category/delete/{id}','App\Http\Controllers\BusinessTypeController@destroy');
Route::put('category/update/{id}','App\Http\Controllers\BusinessTypeController@update');

Route::get('branch','App\Http\Controllers\BranchController@index');
Route::post('branch/create','App\Http\Controllers\BranchController@create');
Route::delete('branch/delete/{id}','App\Http\Controllers\BranchController@destroy');
Route::put('branch/update/{id}','App\Http\Controllers\BranchController@update');


//Route::post('businesstype/create', 'App\Http\Controllers\BusinessTypeController@create')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
//Route::put('businesstype/edit/{id}', 'App\Http\Controllers\BusinessTypeController@edit')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

require __DIR__.'/auth.php';
