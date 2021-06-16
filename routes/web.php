<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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
    return view('frontend.baseLayout');
});
Route::get('/un-authorized-access',[AdminController::class,'unAuthorizedAccess'])->name('unAuthorizedAccess');
Route::prefix('/admin')->group(function (){
    Route::get('',[AdminController::class,'login'])->name('adminLogin');
    Route::post('/login/authenticate',[AdminController::class,'loginAuthenticate'])->name('loginAuthenticate');
    Route::group(['middleware' => ['protectAdmin']],function (){
        Route::get('/dashboard',[AdminController::class,'index'])->name('adminDashboard');

        ///*** Category Section | Route Starts Here  ***///
        Route::get('/view-categories',[AdminController::class,'viewCategories'])->name('viewCategories');
        Route::post('/add-category',[AdminController::class,'addCategory'])->name('addCategory');
        Route::get('/get-category/{id?}',[AdminController::class,'getCategory'])->name('getCategory');
        Route::post('/update-category',[AdminController::class,'updateCategory'])->name('updateCategory');
        Route::get('/delete-category/{id?}',[AdminController::class,'deleteCategory'])->name('deleteCategory');
        ///*** Category Section | Route Ends Here  ***///

        ///*** Collection Section | Route Starts Here  ***///
        Route::get('/view-collections',[AdminController::class,'viewCollections'])->name('viewCollections');
        Route::post('/add-collection',[AdminController::class,'addCollection'])->name('addCollection');
        Route::get('/get-collection/{id?}',[AdminController::class,'getCollection'])->name('getCollection');
        Route::post('/update-collection',[AdminController::class,'updateCollection'])->name('updateCollection');
        Route::get('/delete-collection/{id?}',[AdminController::class,'deleteCollection'])->name('deleteCollection');
        ///*** Collection Section | Route Ends Here  ***///

        ///*** Tag Section | Route Starts Here  ***///
        Route::get('/view-tags',[AdminController::class,'viewTags'])->name('viewTags');
        Route::post('/add-tag',[AdminController::class,'addTag'])->name('addTag');
        Route::get('/get-tag/{id?}',[AdminController::class,'getTag'])->name('getTag');
        Route::post('/update-tag',[AdminController::class,'updateTag'])->name('updateTag');
        Route::get('/delete-tag/{id?}',[AdminController::class,'deleteTag'])->name('deleteTag');
        ///*** Tag Section | Route Ends Here  ***///

        ///*** Product Section | Route Starts Here  ***///
        Route::get('/view-products',[AdminController::class,'viewProducts'])->name('viewProducts');
        Route::get('/add-new-product',[AdminController::class,'addProduct'])->name('addProduct');
        Route::post('/save-product',[AdminController::class,'saveProduct'])->name('saveProduct');
        Route::get('/product-detail/{id?}',[AdminController::class,'productDetail'])->name('productDetail');
        Route::get('/product-image/{id?}',[AdminController::class,'getProductImage'])->name('getProductImage');
        Route::post('/update-product-image',[AdminController::class,'updateProductImage'])->name('updateProductImage');
        Route::get('/remove-product-image/{id?}',[AdminController::class,'removeProductImage'])->name('removeProductImage');
        Route::post('/add-more-product-images',[AdminController::class,'addMoreProductImage'])->name('addMoreProductImage');
        Route::get('/update-product-form/{id?}',[AdminController::class,'updateProductForm'])->name('updateProductForm');
        Route::post('/update-product',[AdminController::class,'updateProduct'])->name('updateProduct');
        Route::get('/remove-product/{id?}',[AdminController::class,'removeProduct'])->name('removeProduct');
        ///*** Product Section | Route Ends Here  ***///

        ///*** Order Section | Route Starts Here  ***///
        Route::get('/view-orders',[AdminController::class,'viewOrder'])->name('viewOrder');
        Route::get('/order-detail/{id?}',[AdminController::class,'orderDetail'])->name('orderDetail');

        ///*** Order Section | Route Ends Here  ***///
        Route::get('/logout',[AdminController::class,'logout'])->name('logout');

    });
});
