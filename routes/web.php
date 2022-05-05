<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
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

// Route::get('/', function () {



//     return view('welcome');
// });

   Route::get('/',[MainController::class, 'login']);
   Route::get('signup',[MainController::class, 'signup']);
   Route::post('signup/create',[MainController::class,'signUpStore']);
   Route::post('login/create',[MainController::class,'checkLogin']);
   Route::get('adminDashboard',[MainController::class, 'adminDashboard']);
   Route::get('/logout', [MainController::class, 'logout']);
   Route::get('/category', [MainController::class, 'category']);
   Route::post('category/create',[MainController::class,'categoryStore']);
   Route::get('category/delete/{id}',[MainController::class,'categoryDelete']);


    Route::get('/product', [MainController::class, 'product']);
   Route::post('product/create',[MainController::class,'productStore']);
   Route::get('product/delete/{id}',[MainController::class,'productDelete']);




   





