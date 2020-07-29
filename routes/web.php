<?php

use App\Package;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;




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


Route::get('login', function () {
    return view('auth.login');   
})->name('login');

Route::get('/', 'HomeController@index')->name('home');

// Route::get('/', function () {
//     return view('auth.login');   
// })->name('login');

// Route::get('/register-view', function ($id) {
//     return view('auth.register');
// })->name('register-view');


Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'news'], function () {
        Route::get('create', 'NewsPostController@create')->name('news-create');
        Route::post('store', 'NewsPostController@store')->name('news-create-store');
        Route::get('index', 'NewsPostController@index')->name('news-index');
        Route::get('show/{id}', 'NewsPostController@show')->name('news-show');
        Route::get('edit/{id}', 'NewsPostController@edit')->name('news-edit');
        Route::post('edit/update/{id}', 'NewsPostController@update')->name('news-edit-update');
        Route::delete('show/delete/{id}', 'NewsPostController@destroy')->name('news-show-delete');

    });

    Route::group(['prefix' => 'tax'], function () {
        Route::get('calculator/index', 'TaxCalculatorController@index')->name('tax-calculator-index');
        Route::delete('calculator/delete/{id}', 'TaxCalculatorController@destroy')->name('tax-calculator-delete');
        Route::post('calculator/store', 'TaxCalculatorController@store')->name('tax-calculator-store');

        Route::get('calender/index', 'TaxCalenderController@index')->name('tax-calender-index');
        Route::delete('calender/delete/{id}', 'TaxCalenderController@destroy')->name('tax-calender-delete');
        Route::post('calender/store', 'TaxCalenderController@store')->name('tax-calender-store');
    });

    Route::get('notification/index', 'NotificationCenterController@index')->name('noti-index');
    Route::post('notification/store', 'NotificationCenterController@store')->name('noti-store');
    Route::delete('notification/delete/{id}', 'NotificationCenterController@destroy')->name('noti-delete');

    Route::get('reg_new_business/index', 'RegisterNewBusinessController@index')->name('reg-business-index');
    Route::post('reg_new_business/store', 'RegisterNewBusinessController@store')->name('reg-business-store');

    Route::get('inc_tax_fill/index', 'IncomeTaxReturnController@index')->name('inc-tax-index');
    Route::post('inc_tax_fill/store', 'IncomeTaxReturnController@store')->name('inc-tax-store');

    Route::get('contacts/index', 'ContactInfoController@index')->name('contacts-index');
    Route::delete('contacts/delete/{id}', 'ContactInfoController@destroy')->name('contacts-delete');
    Route::post('contacts/store', 'ContactInfoController@store')->name('contacts-store');

    Route::get('about_info/index', 'AboutInfoController@index')->name('about-info-index');
    Route::post('about_info/store', 'AboutInfoController@store')->name('about-info-store');

    Route::get('payment_conf_index', 'PaymentConfigurationController@index')->name('pay-conf-index');
    Route::post('payement_conf_update', 'PaymentConfigurationController@update')->name('pay-conf-update');

    Route::get('packages/index', function () {
        $packages = Package::get();
        return view('packages.index', compact('packages'));
    })->name('packages-index');
    Route::delete('packages/delete/{id}', 'PackageController@destroy')->name('packages-delete');
    Route::post('packages/store', 'PackageController@store')->name('packages-store');

    Route::get('subscribers/users', 'SubscriptionController@index')->name('sub-index');
    Route::get('subscribers/expired_subs', 'SubscriptionController@expired')->name('sub-expired');

});




// Route::group(['prefix' => 'error'], function(){
//     Route::get('404', function () { return view('pages.error.404'); });
//     Route::get('500', function () { return view('pages.error.500'); });
// });

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::get('/storage-link/1952', function(){
    Artisan::call('storage:link', []);
    return 'Linked';
});

// 404 for undefined routes
Route::any('/{page?}',function(){
    return View::make('layouts.404');
})->where('page','.*');

