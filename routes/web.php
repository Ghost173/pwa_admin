<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\admin\AdminCRUCController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



Route::group(['prefix' => 'admin', 'middleware' =>['admin:admin']], function() {
    Route::get('/login' , [AdminController::class, 'loginform' ])->name('admin.loginform');
    Route::post('/login' , [AdminController::class, 'store' ])->name('admin.login');
 

});

Route::get('/adminprofile' , [AdminCRUCController::class, 'adminprofile' ])->name('admin.profile')->middleware('auth:admin');


Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('admindashboard')->middleware('auth:admin');


Route::middleware(['auth:admin'])->group(function() {
    Route::get('admin/logout' , [AdminController::class, 'destroy' ])->name('admin.logout');
});