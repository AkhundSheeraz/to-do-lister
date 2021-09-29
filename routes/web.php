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
Route::middleware(['verified'])->group(function () {

    Route::get('/home', [checklistController::class, 'stats'])->name('home');

    Route::get('/group', [groupController::class, 'fetchGroups'])->name('group');

    Route::get('/checklist', [checklistController::class, 'Get_groups'])->name('checklist');

    Route::get('/view_list/{id}', [checklistController::class, 'get_taskoritems'])->name('view_list');

    Route::get('/addfriends', [userController::class, 'show_friends'])->name('addingfriends');
});



Route::get('/', function () {
    return view('login');
})->name('login')->middleware('guest');


Route::get('/register', function () {
    return view('register');
})->middleware('guest');


Route::get('/redirect', [userController::class, 'google_redirect']);

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/forgetpassword', function () {
    return view('auth.forget-password');
})->middleware('guest')->name("password.request");

Route::get('/microsoft', [userController::class, 'microsoft'])->name('microsoft');

Route::get('/google', [userController::class, 'google'])->name('google');

// Route::get('/google/redirect', [userController::class, 'google_redirect']);

Route::get('/microsoft/redirect', [userController::class, 'microsoft_redirect']);

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

Route::post('/forget-password', [
    userController::class, 'reset_Passwords'
])->middleware('guest')->name('password.email');

Route::post('/reset-password', [
    userController::class, 'set_new_password'
])->middleware('guest')->name('password.update');
