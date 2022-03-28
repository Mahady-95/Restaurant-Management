<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;


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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/',[HomeController::class,'index']);
Route::get('/users',[AdminController::class,'user']);
Route::get('/deletemenu/{id}',[AdminController::class,'deleteMenu']);
Route::get('/updatemenu/{id}',[AdminController::class,'updateMenu']);
Route::post('/updatefood/{id}',[AdminController::class,'updateFood']);
Route::post('/reservation',[AdminController::class,'reservation']);
Route::get('/viewreservation',[AdminController::class,'viewReservation']);
Route::get('/viewchef',[AdminController::class,'viewChef']);
Route::post('/uploadchef',[AdminController::class,'uploadChef']);
Route::get('/updatechef/{id}',[AdminController::class,'updateChef']);
Route::post('/updatefoodchef/{id}',[AdminController::class,'updateFoodChef']);
Route::get('/deletechef/{id}',[AdminController::class,'deleteChef']);
Route::post('/addcart/{id}',[HomeController::class,'addCart']);
Route::get('/showcart/{id}',[HomeController::class,'showCart']); 
Route::get('/remove/{id}',[HomeController::class,'removeCart']); 
Route::post('/orderconfirm',[HomeController::class,'orderConfirm']);
Route::get('/orders',[AdminController::class,'orders']);
Route::get('/search',[AdminController::class,'search']);

Route::get('/foodmenu',[AdminController::class,'foodMenu']);
Route::post('/uploadfood',[AdminController::class,'uploadFood']);
Route::get('/deleteuser/{id}',[AdminController::class,'deleteUser']);

Route::get('/redirects',[HomeController::class,'redirects']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
