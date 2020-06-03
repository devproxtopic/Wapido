<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', function(){
    return view('auth.login');
});

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    return "Cache is cleared";
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index');

    Route::get('logout', 'Auth\LoginController@logout', function () {
        return abort(404);
    });

    // AJAX

    Route::get('/ajax/measures-categories/{category_id}', function ($category_id) {
        return response(json_decode(App\Models\Category::find($category_id)->measure));
    });

    Route::prefix('owners/{slug}')->group(function () {
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

        Route::resource('/countries', 'CountriesController')->except('destroy');
        Route::get('/countries-delete/{id}', 'CountriesController@destroy')
        ->name('countries.destroy');

        Route::resource('/cities', 'CitiesController')->except('destroy');
        Route::get('/cities-delete/{id}', 'CitiesController@destroy')
        ->name('cities.destroy');

        Route::resource('/states', 'StatesController')->except('destroy');
        Route::get('/states-delete/{id}', 'StatesController@destroy')
        ->name('states.destroy');

        Route::resource('/locations', 'LocationsController')->except('destroy');
        Route::get('/locations-delete/{id}', 'LocationsController@destroy')
        ->name('locations.destroy');
        Route::get('/locations-massive', 'LocationsController@massive');
        Route::post('/locations-massive', 'LocationsController@massiveStore');
    });

    Route::resource('/home/owners', 'OwnersController')->except('destroy', 'show');
    Route::get('/home/owners-delete/{id}', 'OwnersController@destroy')
    ->name('owners.destroy');
    Route::get('owner/{id}', 'OwnersController@show')
    ->name('owners.show');

});

Route::group(['middleware' => 'web'], function () {
    Route::get('/{slug}', 'IndexController');
    Route::get('/ajax/emails/{email}', function ($email) {
        return response(App\Models\Client::where('email', $email)->first());
    });
    Route::post('/{slug}/orders-store', 'OrdersController@store')
        ->name('orders.store');
    Route::get('/{slug}/orders-show/{id}', 'OrdersController@show')
        ->name('orders.show');
});
