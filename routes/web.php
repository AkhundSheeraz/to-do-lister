<?php

use App\Http\Controllers\checklistController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\groupController;
use App\Http\Controllers\itemController;
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
})->name('home')->middleware('verified');

Route::get('/group', [
    groupController::class, 'fetchGroups'
])->name('group')->middleware('verified');

Route::get('/checklist', [
    checklistController::class, 'Get_groups'
])->name('checklist')->middleware('verified');

Route::get('/view_list/{id}', [
    checklistController::class, 'get_taskoritems'
])->name('view_list')->middleware('verified');

Route::get('/register', function () {
    return view('register');
});

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/forgetpassword', function () {
    return view('forgetpass');
});

Route::get('/logout', [userController::class, 'logoutUser']);

//Post Requests
Route::post('/registersuccess', [userController::class, 'registerUser']);
Route::post('/login_user', [userController::class, 'loginUser']);
Route::post('/add_group', [groupController::class, 'addGroup']);
Route::post('/add_checklist', [checklistController::class, 'add_checklist']);
Route::post('/add_item', [checklistController::class, 'insert_taskorItem']);
Route::post('/status', [itemController::class, 'change_status']);

Route::post('/email/verification-notification', [
    userController::class, 'resend_Verification_mail'
])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
