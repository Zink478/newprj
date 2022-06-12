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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/allitems', [\App\Http\Controllers\ItemController::class, 'index'])->name('items.show');
//Route::get('/items', [\App\Http\Controllers\ItemController::class, 'fetch'])->name('item.fetch');
Route::post('/items', [App\Http\Controllers\ItemController::class, 'store'])->name('item.store');
//Route::get('/items/{item}', [\App\Http\Controllers\ItemController::class, 'show'])->name('item.show');
Route::post('/items/{id}', [\App\Http\Controllers\ItemController::class, 'edit'])->name('item.edit');
Route::delete('/delete/{id}', [\App\Http\Controllers\ItemController::class, 'destroy'])->name('item.delete');
Route::get('/getuserid', [\App\Http\Controllers\ItemController::class, 'userid'])->name('user.id');

