<?php

use App\Http\Controllers\groupController;
use App\Http\Controllers\userController;
use Illuminate\Http\Request;
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

Route::get('/', function () {
    return view('login');
})->name('login')->middleware('guest');

Route::get('/home', function () {
    return view('welcome');
})->name('home')->middleware('auth');

Route::get('/group', function () {
    return view('groups');
})->name('group')->middleware('auth');

Route::get('/register', function () {
    return view('register');
});

Route::get('/forgetpassword', function () {
    return view('forgetpass');
});

Route::get('/logout', [userController::class, 'logoutUser']);

//Post Requests
Route::post('/registersuccess', [userController::class, 'registerUser']);
Route::post('/login_user', [userController::class, 'loginUser']);
Route::post('/add_group', [groupController::class, 'addGroup']);

