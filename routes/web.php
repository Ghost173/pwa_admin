<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\admin\AdminCRUCController;
use App\Http\Controllers\admin\AdminCategoryController;

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



Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('admindashboard')->middleware('auth:admin');


Route::middleware(['auth:admin'])->group(function() {
    Route::get('admin/logout' , [AdminController::class, 'destroy' ])->name('admin.logout');
});



Route::group(['prefix' => 'admin', 'middleware' =>['admin:admin']], function() {
    Route::get('/login' , [AdminController::class, 'loginform' ])->name('admin.loginform');
    Route::post('/login' , [AdminController::class, 'store' ])->name('admin.login');
 
});

Route::middleware(['auth:admin'])->group(function() {
    Route::get('/admin/profile' , [AdminCRUCController::class, 'adminprofile' ])->name('admin.profile');
    Route::post('/admin/profile/store' , [AdminCRUCController::class, 'adminprofilestore' ])->name('admin.profile.store');
    Route::post('/admin/password/store' , [AdminCRUCController::class, 'adminpasswordstore' ])->name('admin.password.store');
    Route::get('/admin/testbucket' , [AdminCRUCController::class, 'testbucket' ])->name('admin.testbucket');
});



//admin category related end points 
Route::group(['prefix' => 'category', 'middleware' =>'auth:admin'], function() {
    Route::get('all' , [AdminCategoryController::class, 'getallcategories' ])->name('admin.getcategories');
    Route::get('add' , [AdminCategoryController::class, 'addcategory' ])->name('admin.addcategory');
    Route::post('store' , [AdminCategoryController::class, 'storecategory' ])->name('admin.storecategory');
    Route::get('edit/{id}' , [AdminCategoryController::class, 'editcategory' ])->name('admin.editcategory');
    Route::get('delete/{id}' , [AdminCategoryController::class, 'deletecategory' ])->name('admin.deletecategory');

});


// Route::get('/admin/profile' , [AdminCRUCController::class, 'adminprofile' ])->name('admin.profile')->middleware('auth:admin');
// Route::get('/admin/profile/store' , [AdminCRUCController::class, 'adminprofile' ])->name('admin.profile.store')->middleware('auth:admin');



//Admin Category CRUD
