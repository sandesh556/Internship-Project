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

Route::get('/', [\App\Http\Controllers\PagesController::class,'home']);
Route::get('/about',[\App\Http\Controllers\PagesController::class,'about']);
Route::get('/contact',[\App\Http\Controllers\TicketsController::class,'create']);
Route::post('/contact',[\App\Http\Controllers\TicketsController::class,'store']);
Route::get('/tickets',[\App\Http\Controllers\TicketsController::class,'index']);
Route::get('/tickets/{slug}',[\App\Http\Controllers\TicketsController::class,'show']);
Route::get('/tickets/{slug}/edit',[\App\Http\Controllers\TicketsController::class,'edit']);
Route::post('/tickets/{slug}/edit',[\App\Http\Controllers\TicketsController::class,'update']);
Route::post('/tickets/{slug}/delete',[\App\Http\Controllers\TicketsController::class,'destroy']);
Route::post('/comments',[App\Http\Controllers\CommentsController::class,'newComment']);
