<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'IndexController');
Route::get('/ajax/emails/{email}', function($email){
    return response(App\Client::where('email', $email)->first());
});
Route::post('/orders-store', 'OrdersController@store')
    ->name('orders.store');
Route::get('/orders-show/{id}', 'OrdersController@show')
    ->name('orders.show');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index');

    Route::get('logout', 'Auth\LoginController@logout', function () {
        return abort(404);
    });

    Route::resource('/categories', 'CategoriesController')->except('destroy');
    Route::get('/categories-delete/{id}', 'CategoriesController@destroy')
        ->name('categories.destroy');

    Route::resource('/items', 'ItemsController')->except('destroy');
    Route::get('/items-delete/{id}', 'ItemsController@destroy')
        ->name('items.destroy');

    Route::resource('/clients', 'ClientsController')->except('destroy');
    Route::get('/clients-delete/{id}', 'ClientsController@destroy')
        ->name('clients.destroy');

    Route::resource('/orders', 'OrdersController')->except('destroy','store','show');
    Route::get('/orders-delete/{id}', 'OrdersController@destroy')
        ->name('orders.destroy');

    Route::resource('/status', 'StatusController')->except('destroy');
    Route::get('/status-delete/{id}', 'StatusController@destroy')
        ->name('status.destroy');

    Route::resource('/units', 'UnitController')->except('destroy');
    Route::get('/units-delete/{id}', 'UnitController@destroy')
        ->name('units.destroy');

    Route::resource('/promotions', 'PromotionController')->except('destroy');
    Route::get('/promotions-delete/{id}', 'PromotionController@destroy')
        ->name('promotions.destroy');

    Route::post('/owners', 'OwnerController');

    // AJAX

    Route::get('/ajax/measures-categories/{category_id}', function($category_id){
        return response(json_decode(App\Category::find($category_id)->measure));
    });

});

