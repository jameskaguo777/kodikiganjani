<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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

Route::post('/login', 'AuthController@login');

Route::post('/register', 'AuthController@register');

Route::post('/callback', 'API\PaidSubscribersController@callback');

Route::post('/sanctum/token', function (Request $request) {
  $request->validate([
      'email' => 'required|email',
      'password' => 'required',
      'device_name' => 'required',
  ]);

  $user = User::where('email', $request->email)->first();

  if (! $user || ! Hash::check($request->password, $user->password)) {
      throw ValidationException::withMessages([
          'email' => ['The provided credentials are incorrect.'],
      ]);
  }

  $tokenResult = $user->createToken($request->device_name)->plainTextToken;

  return response()->json([
          'status_code'=> 200,
          'access_token' => $tokenResult,
          'token_type' => 'Bearer',
      ]);
  
});

Route::middleware(['auth:sanctum'])->group(function () {
  Route::get('/users_index', 'AuthController@index');
  Route::get('/about_info_index', 'API\AboutInfoController@index');
  Route::get('/contact_info_index', 'API\ContactInfoController@index');
  Route::get('/income_tax_index', 'API\IncomeTaxReturnController@index');
  Route::get('/news_post_index', 'API\NewsPostController@index');
  Route::get('/notification_center_index', 'API\NotificationCenterController@index');
  Route::get('/packages_index', 'API\PackageController@index');
  Route::get('/reg_new_business_index', 'API\RegisterNewBusinessController@index');
  Route::get('/subscriber_index', 'API\SubscriptionController@index');
  Route::get('/tax_calculator_index', 'API\TaxCalculatorController@index');
  Route::get('/tax_calender_index', 'API\TaxCalenderController@index');
  Route::post('/payment', 'API\PaidSubscribersController@push');
  Route::post('/logout/{id}', function($id, User $user){
    $user->tokens()->where('id', $id)->delete();
  });
});
