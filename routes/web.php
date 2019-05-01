<?php

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
  return redirect('home');
});


Auth::routes();

Route::get('home', 'HomeController@index');

Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder');

Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate');

Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate');


Route::resource('brands', 'BrandsController');

Route::resource('models', 'ModelsController');
Route::get('export_model', 'ModelsController@modelsExport');


Route::resource('items', 'ItemsController');



Route::resource('clients', 'ClientsController');
Route::get('export', 'ClientsController@clientsExport');

Route::resource('clientTypes', 'ClientTypesController');
Route::get('export_client_type', 'ClientTypesController@clientsTypeExport');

Route::resource('branches', 'BranchesController');
Route::get('export_branch', 'BranchesController@branchExport');


Route::resource('employees', 'EmployeesController');
Route::get('export_employee', 'EmployeesController@employeesTypeExport');


Route::resource('anauthorized', 'AnauthorizedController');

Route::resource('warehouses', 'WarehouseController');
Route::get('export_warehouse', 'WarehouseController@warehouseExport');

Route::resource('warehouseTransctions', 'WarehouseTransctionController');

Route::resource('mainStocks', 'MainStockController');

Route::resource('mainStockTransctions', 'MainStockTransctionsController');

Route::resource('stocks', 'StocksController');

Route::resource('stockMovements', 'stockMovementsController');

Route::resource('sales', 'SalesController');
Route::get('destroy_cart/{id}', 'SalesController@destroyCartItem');

Route::get('model-branch/{branch_id}', 'ModelsController@getModelByBranch');


Route::post('add_cart', 'SalesController@addCartItem');


Route::resource('salesItems', 'SalesItemsController');