<?php

use App\Http\Controllers\PayOrderController;
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

Route::get('/get-products', [PayOrderController::class, 'getProducts']);
Route::get('/set-products', [PayOrderController::class, 'setProduct']);

Route::get('mybook-link', function(){
    return 'My Book Link';
});