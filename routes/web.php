<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/register', function () {
    return view('auth.register');
});
Route::post('/register', [AuthenticationController::class, 'register'])->name('register');


Route::get('/login', function () {
    return view('auth.login');
});
Route::post('/login', [AuthenticationController::class, 'login'])->name('login');
Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');

Route::get('/pay', function () {
    $user = Auth::user();
    $price = $user->register_price;
    return view('pay', compact('price'));
})->name('pay');

Route::post('/updatePaid', [UserController::class, 'update_paid'])->name('updatePaid');

Route::get('/overpayment', [UserController::class, 'handleOverpayment'])->name('handleOverpayment');
Route::post('/overpayment', [UserController::class, 'processOverpayment'])->name('processOverpayment');

Route::middleware(['auth', 'paid'])->group(function(){
    Route::get('/', function(){
        return view('home');
    });

    Route::resource('user', UserController::class);
    Route::resource('friend_request', FriendRequestController::class);
    Route::resource('friend', FriendController::class);
    Route::resource('message', MessageController::class);
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
});