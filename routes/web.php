<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\admin\AdminCRUCController;
use App\Http\Controllers\admin\AdminCategoryController;
use App\Http\Controllers\admin\AdminSubCategoryController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ManageordersController;
use App\Http\Controllers\admin\ReviewController;
use App\Http\Controllers\admin\MessagesController;
use App\Http\Controllers\admin\NotificationController;
use App\Http\Controllers\admin\UserController;

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
    Route::get('delete/{id}' , [AdminCategoryController::class, 'deletecategory' ])->name('admin.deletecategory');
    Route::get('edit/{id}' , [AdminCategoryController::class, 'editcategory' ])->name('admin.editcategory');
    Route::post('updatecategoryName/{id}' , [AdminCategoryController::class, 'updatecategoryName' ])->name('admin.updatecategoryName');
    Route::post('updatecategoryImage/{id}' , [AdminCategoryController::class, 'updatecategoryImage' ])->name('admin.updatecategoryImage');


});


//admin category related end points 
Route::group(['prefix' => 'subcategory', 'middleware' =>'auth:admin'], function() {
    Route::get('all' , [AdminSubCategoryController::class, 'getallsubcategories' ])->name('admin.getallsubcategories');
    Route::get('add' , [AdminSubCategoryController::class, 'addsubcategory' ])->name('admin.addsubcategory');
    Route::post('store' , [AdminSubCategoryController::class, 'storesubcategory' ])->name('admin.storesubcategory');
    Route::get('delete/{id}' , [AdminSubCategoryController::class, 'deletesubcategory' ])->name('admin.deletesubcategory');
    Route::get('edit/{id}' , [AdminSubCategoryController::class, 'editsubcategory' ])->name('admin.editsubcategory');
    Route::post('updatesubcategoryName/{id}' , [AdminSubCategoryController::class, 'updatesubcategoryName' ])->name('admin.updatesubcategoryName');


});

// home page slider 
Route::group(['prefix' => 'slider', 'middleware' =>'auth:admin'], function() {
    Route::get('all' , [SliderController::class, 'getallsliders' ])->name('admin.getallsliders');
    Route::get('add' , [SliderController::class, 'addslider' ])->name('admin.addslider');
    Route::post('store' , [SliderController::class, 'storeslider' ])->name('admin.storeslider');
    Route::get('delete/{id}' , [SliderController::class, 'deleteslider' ])->name('admin.deleteslider');
    Route::get('active/{id}' , [SliderController::class, 'activeslider' ])->name('admin.activeslider');
    Route::get('deactive/{id}' , [SliderController::class, 'deactiveslider' ])->name('admin.deactiveslider');
});


// products
Route::group(['prefix' => 'product', 'middleware' =>'auth:admin'], function() {
    Route::get('all' , [ProductController::class, 'getallproducts' ])->name('admin.getallproducts');
    Route::get('activate/{id}' , [ProductController::class, 'activateproduct' ])->name('admin.activateproduct');
    Route::get('deactivate/{id}' , [ProductController::class, 'deactivateproduct' ])->name('admin.deactivateproduct');
    Route::get('add' , [ProductController::class, 'addproduct' ])->name('admin.addproduct');
    Route::post('store' , [ProductController::class, 'storeproduct' ])->name('admin.storeproduct');
    Route::get('delete/{id}' , [ProductController::class, 'deleteproduct' ])->name('admin.deleteproduct');
});


//Orders 
Route::group(['prefix' => 'orders', 'middleware' =>'auth:admin'], function() {
    Route::get('pendingoders' , [ManageordersController::class, 'getpendingorders' ])->name('admin.getallpendongorders');
    Route::get('processingoders' , [ManageordersController::class, 'getallprocessingoders' ])->name('admin.getallprocessingoders');
    Route::get('completeorders' , [ManageordersController::class, 'getallcompleteorders' ])->name('admin.getallcompleteorders');
    Route::get('cancelorders' , [ManageordersController::class, 'getallcancelorders' ])->name('admin.getallcancelorders');
    Route::get('oderdetails/{id}' , [ManageordersController::class, 'oderdetailsbyid' ])->name('admin.orderdetailsbyid');
    Route::get('pendingtoprocessing/{id}' , [ManageordersController::class, 'pendingtoprocessing' ])->name('admin.pendingtoprocessing');
    Route::get('processingtoconfirm/{id}' , [ManageordersController::class, 'processingtoconfirm' ])->name('admin.processingtoconfirm');
    Route::get('confirmtocancel/{id}' , [ManageordersController::class, 'confirmtocancel' ])->name('admin.confirmtocancel');
    Route::post('updatepaymentid/{id}' , [ManageordersController::class, 'updatepaymentid' ])->name('admin.updatepaymentid');
});

// Review
Route::group(['prefix' => 'review', 'middleware' =>'auth:admin'], function() {
    Route::get('allpendingreview' , [ReviewController::class, 'allpendingreviews' ])->name('admin.allpendingreviews');
    Route::get('allapprovedreview' , [ReviewController::class, 'allapprovedreview' ])->name('admin.allapprovedreviews');
    Route::get('approvereview/{id}' , [ReviewController::class, 'approvereview' ])->name('admin.approvereview');
    Route::get('markaspending/{id}' , [ReviewController::class, 'deactivereview' ])->name('admin.deactivereview');
});


// Contact us
Route::group(['prefix' => 'contactus', 'middleware' =>'auth:admin'], function() {
    Route::get('get/messages' , [MessagesController::class, 'getallmessges' ])->name('admin.getallmessges');
});

// Notifications
Route::group(['prefix' => 'notificatiuons', 'middleware' =>'auth:admin'], function() {
    Route::get('get/all' , [NotificationController::class, 'getallnotificatiuons' ])->name('admin.getallnotificatiuons'); 
    Route::get('get/add' , [NotificationController::class, 'addnotificatiuons' ])->name('admin.addnotificatiuons'); 
    Route::get('deactive/{id}' , [NotificationController::class, 'notificationdeactive' ])->name('admin.notificationdeactive'); 
    Route::get('active/{id}' , [NotificationController::class, 'notificationactive' ])->name('admin.notificationactive'); 
    Route::get('add' , [NotificationController::class, 'addnotification' ])->name('admin.addnotification'); 
    Route::post('store' , [NotificationController::class, 'storenotification' ])->name('admin.storenotification'); 
});

//UserController
Route::group(['prefix' => 'users', 'middleware' =>'auth:admin'], function() {
    Route::get('get/all' , [UserController::class, 'index' ])->name('admin.getallusers');
});


Route::get('category/subcategory/ajax/{product_category_id}' , [ProductController::class, 'categorysub' ]);


