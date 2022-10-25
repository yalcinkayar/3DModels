<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('/demand', '\App\Http\Controllers\DemandController')->middleware(['auth']);
Route::get('/demand.status/{demandId}/{statusId}', [\App\Http\Controllers\DemandController::class,'status'])
->name('demand.status')
->middleware(['auth']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('admin.login', [\App\Http\Controllers\admin\AuthController::class, 'login'])->name('admin.login'); 
Route::post('admin.register', [\App\Http\Controllers\admin\AuthController::class, 'admin_register'])->name('admin.register'); 
Route::post('admin.logout', [\App\Http\Controllers\admin\AuthController::class, 'logout'])->name('admin.logout'); 

Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
Route::get('/product/{productId}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');
Route::get('/product.edit/{productId}', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
Route::post('/product.edit/{productId}', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
Route::get('/product.delete/{productId}', [App\Http\Controllers\ProductController::class, 'delete'])->name('product.delete');
Route::get('/product.create', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
Route::post('/created-product', [App\Http\Controllers\ProductController::class, 'store'])->name('createdProduct');
Route::get('/getData', [App\Http\Controllers\ProductController::class, 'getData'])->name('product.getData');

Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');
Route::get('/category.edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category.edit/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');
Route::get('/category.delete/{id}', [App\Http\Controllers\CategoryController::class, 'delete'])->name('category.delete');
Route::get('/category.create', [App\Http\Controllers\CategoryController::class, 'create'])->name('category.create');
Route::post('/category.post', [App\Http\Controllers\CategoryController::class, 'store'])->name('category.post');
Route::get('/category.getData', [App\Http\Controllers\CategoryController::class, 'categoryGetData'])->name('category.getData');

Route::get('/subcategory', [App\Http\Controllers\SubCategoryController::class, 'index'])->name('subcategory.index');
Route::get('/subcategory.create', [App\Http\Controllers\SubCategoryController::class, 'create'])->name('subcategory.create');
Route::post('/subcategory.post', [App\Http\Controllers\SubCategoryController::class, 'store'])->name('subcategory.post');
Route::get('/subcategory.edit/{subcategoryId}/{category_id}', [App\Http\Controllers\SubCategoryController::class, 'edit'])->name('subcategory.edit');
Route::post('/subcategory.edit/{subcategoryId}', [App\Http\Controllers\SubCategoryController::class, 'update'])->name('subcategory.update');
Route::get('/subcategory.delete/{subcategoryId}', [App\Http\Controllers\SubCategoryController::class, 'delete'])->name('subcategory.delete');
Route::get('/subcategory.getData', [App\Http\Controllers\SubCategoryController::class, 'subcategoryGetData'])->name('subcategory.getData');

