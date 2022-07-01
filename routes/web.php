<?php

use App\Events\Item;
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

Auth::routes();

Route::get('/parse', [\App\Http\Controllers\ParseController::class, 'index']);
Route::get('/posts', [\App\Http\Controllers\ParseController::class, 'show']);
Route::get('/posts/get', [\App\Http\Controllers\ParseController::class, 'get']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/allitems', [\App\Http\Controllers\ItemController::class, 'index'])->name('items.show');
//Route::get('/items', [\App\Http\Controllers\ItemController::class, 'fetch'])->name('item.fetch');
Route::post('/items', [App\Http\Controllers\ItemController::class, 'store'])->name('item.store');
//Route::get('/items/{item}', [\App\Http\Controllers\ItemController::class, 'show'])->name('item.show');
Route::post('/items/{id}', [\App\Http\Controllers\ItemController::class, 'edit'])->name('item.edit');
Route::delete('/delete/{id}', [\App\Http\Controllers\ItemController::class, 'destroy'])->name('item.delete');
Route::get('/getuserid', [\App\Http\Controllers\ItemController::class, 'userid'])->name('user.id');

Route::group([
    'prefix' => 'api/v1/'
], function() {
    Route::get('/items', [\App\Http\Controllers\api\v1\ItemController::class, 'index']);
    Route::post('/items', [\App\Http\Controllers\api\v1\ItemController::class, 'store']);
    Route::get('/items/{id}', [\App\Http\Controllers\api\v1\ItemController::class, 'show']);

    Route::get('/price/{sum}', [\App\Http\Controllers\api\v1\ItemController::class, 'price']);
    Route::get('/itemsLimited', [\App\Http\Controllers\api\v1\ItemController::class, 'indexLimited']);
});
