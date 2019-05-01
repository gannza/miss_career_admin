<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('brands', 'BrandsAPIController');

Route::resource('models', 'ModelsAPIController');


Route::resource('items', 'ItemsAPIController');

Route::resource('clients', 'ClientsAPIController');

Route::resource('clientTypes', 'ClientTypesAPIController');

Route::resource('branches', 'BranchesAPIController');

Route::resource('employees', 'EmployeesAPIController');

Route::resource('warehouses', 'WarehouseAPIController');

Route::resource('warehouse_transctions', 'WarehouseTransctionAPIController');

Route::resource('main_stocks', 'MainStockAPIController');

Route::resource('main_stock_transctions', 'MainStockTransctionsAPIController');

Route::resource('stocks', 'StocksAPIController');

Route::resource('stock_movements', 'stockMovementsAPIController');

Route::resource('sales', 'SalesAPIController');

Route::resource('sales_items', 'SalesItemsAPIController');