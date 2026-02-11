<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CommonController;

use App\Http\Middleware\CheckIsAuthor;

Route::get('/', [UserController::class, 'index'])->name('login');;
Route::get('/register',function(){
	return view('user.register');
})->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login.post');
Route::post('/sign', [UserController::class, 'sign'])->name('sign.post');
Route::get('logout',[UserController::class, 'logout'])->name('logout');



Route::middleware(['auth', CheckIsAuthor::class])->group(function () {
	Route::get('/common', [CommonController::class, 'index'])->name('home');
    Route::post('/addcommon',[CommonController::class, 'addcommon'])->name('common_insert');  
});