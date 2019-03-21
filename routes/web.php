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

Route::get('/home', 'HomeController@index');

Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder');

Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate');

Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate');


Route::resource('brands', 'BrandsController');

Route::resource('models', 'ModelsController');


Route::resource('items', 'ItemsController');



Route::resource('clients', 'ClientsController');

Route::resource('clientTypes', 'ClientTypesController');

Route::resource('branches', 'BranchesController');

Route::resource('employees', 'EmployeesController');

Route::resource('anauthorized', 'AnauthorizedController');

Route::resource('warehouses', 'WarehouseController');

Route::resource('warehouseTransctions', 'WarehouseTransctionController');

Route::resource('mainStocks', 'MainStockController');

Route::resource('mainStockTransctions', 'MainStockTransctionsController');