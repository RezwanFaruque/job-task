<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products',[ProductController::class,'index'])->name('product.getproducts');
Route::get('/product/{id}',[ProductController::class,'editProduct'])->name('product.edit');

Route::post('/store-product',[ProductController::class,'storeProduct'])->name('product.store');
Route::post('/update-product/{id}',[ProductController::class,'updateProduct'])->name('product.update');
Route::delete('/delete-product/{id}',[ProductController::class,'deleteProduct'])->name('product.delete');

Route::get('/categories',[ProductController::class,'getCategory'])->name('product.getcategories');