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
use App\Models\Restaurant;
use App\Models\User;

Route::get('/', function () {
    $restaurants = Restaurant::take(10)->get();
    //dd($restaurants);
    return view('home', compact('restaurants'));
});

Route::post('/restaurant/add_picture', 'RestaurantController@add_picture')->name('add_picture');
Route::get('/users/change_password/{id}', function($id) {
    $user = User::findOrFail($id);
    return view('users.change_password', compact('user'));
})->name('change_password');

Route::put('/users/change_rights/{id}', 'UserController@changeRights')->name('change_rights');
Route::put('/users/edit_password/{id}', 'UserController@editPassword')->name('edit_password');

Route::resource('/restaurant', 'RestaurantController');
Route::resource('/users', 'UserController');
Route::resource('/reviews', 'ReviewController');

Auth::routes();

