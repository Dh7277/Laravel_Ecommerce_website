<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminLoginController;    
use App\Http\Controllers\Admin\HomeController;    

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin'], function(){
    //Those routes in which login is not required is defined here   
    Route::group(['middleware' => 'admin.guest'], function(){
        Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login.route');
        Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');

    }); 
  
    //Those routes in which login is required will be defined here
    Route::group(['middleware' => 'admin.auth'], function(){
        Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');

    }); 

}); 