<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VisitorController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\SiteinfoController;
use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ProductListController;
use App\Http\Controllers\Api\ApiSliderController;
use App\Http\Controllers\Api\ApiNotificationController;
use App\Http\Controllers\Api\AuthController;

use App\Http\Controllers\Api\ProductReviewController;
use App\Http\Controllers\Api\ProductCartController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/createvisitor', [VisitorController::class, 'create']);

//contact api 
Route::post('/postcontact' , [ContactController::class, 'create']);

//site info get(about us, refund, address, social links....) 
Route::get('/allsiteinfo' , [SiteinfoController::class, 'index']);


// All category api
Route::get('/allcategory' , [ApiCategoryController::class, 'index']);


//products
Route::get('/productlistbyremark/{remark}' , [ProductListController::class, 'productlistremark']);

//Product list based on the category 
Route::get('/productlistbycategory/{category_id}' , [ProductListController::class, 'productlistbycategory']);


//Single product details 
Route::get('/productdetails/{product_id}' , [ProductListController::class, 'SingleproductDetails']);

//Suggest product based on the selected products in the single product list 
Route::get('/suggestproducts/{product_id}' , [ProductListController::class, 'suggestproducts']);

//Product list based on the subcategory 
Route::get('/productlistbysubcategory/{category_id}/{subcategory_id}' , [ProductListController::class, 'productlistbysubcategory']);

//search
Route::get('/search/{key}' , [ProductListController::class, 'searchProduct']);



//Get feature products 
Route::get('/featureProducts' , [ProductListController::class, 'featureProducts']);

//Get NEW ARRIVALS  products 
Route::get('/newarrivals' , [ProductListController::class, 'newarrivals']);

//GetColletion products  
Route::get('/productscolletions' , [ProductListController::class, 'productscolletions']);


//get home page slider
Route::get('/getsliders' , [ApiSliderController::class, 'getSliders']);




//Notification 
Route::get('/getnotifications' , [ApiNotificationController::class, 'getNotifications']);


//UserLogin
Route::post('/login' , [AuthController::class, 'Login']);
Route::post('/register' , [AuthController::class, 'Register']);
Route::post('/logout' , [AuthController::class, 'logout']);
Route::post('/forgotpassword' , [AuthController::class, 'forgotpassword']);
Route::post('/restpassword' , [AuthController::class, 'restpassword']);
Route::get('/user' , [AuthController::class, 'user'])->middleware('auth:api');



//reviews for products 
Route::get('/reviewlists/{id}' , [ProductReviewController::class, 'getAllReviewList']);


//product add to cart 
Route::post('/addtocart' , [ProductCartController::class, 'addtocart']);
Route::get('/cartcount/{id}' , [ProductCartController::class, 'cartcount']);
Route::get('/getcartitems' , [ProductCartController::class, 'getcartitems'])->middleware('auth:api');
Route::get('/removecartitem/{cart_id}' , [ProductCartController::class, 'removecartitem'])->middleware('auth:api');
Route::get('/cartitemplus/{cart_id}' , [ProductCartController::class, 'cartitemplus'])->middleware('auth:api');
Route::get('/cartitemminus/{cart_id}' , [ProductCartController::class, 'cartitemminus'])->middleware('auth:api');
