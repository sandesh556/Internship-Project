<?php



namespace App\Http\Controllers\Admin;

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
Route::post('/comments',[\App\Http\Controllers\CommentsController::class,'newComment']);


Route::get('/register', [\App\Http\Controllers\PassportController::class,'showRegistrationForm']);
Route::post('/register', [\App\Http\Controllers\PassportController::class,'register']);
Route::get('/login', [\App\Http\Controllers\PassportController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\PassportController::class,'login']);
Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class,'logout']);

Route::group(array('prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'manager')
    , function () {
        Route::get('users', [UsersController::class,'index']);
        Route::get('roles',[RolesController::class,'index']);
        Route::get('roles/create',[RolesController::class,'create']);
        Route::post('roles/create',[RolesController::class,'store']);
        Route::get('users/{id?}/edit', [UsersController::class,'edit']);
        Route::post('users/{id?}/edit',[UsersController::class,'update']);
        Route::get('/',[PagesController::class,'home']);
        Route::get('posts', [PostsController::class,'index']);
        Route::get('posts/create', [PostsController::class,'create']);
        Route::post('posts/create', [PostsController::class,'store']);
        Route::get('posts/{id?}/edit', [PostsController::class,'edit']);
        Route::post('posts/{id?}/edit',[PostsController::class,'update']);











        Route::get('/tickets',[\App\Http\Controllers\TicketsController::class,'index']);
        Route::get('/tickets/{slug}',[\App\Http\Controllers\TicketsController::class,'show']);
        Route::get('/tickets/{slug}/edit',[\App\Http\Controllers\TicketsController::class,'edit']);
        Route::post('/tickets/{slug}/edit',[\App\Http\Controllers\TicketsController::class,'update']);
        Route::post('/tickets/{slug}/delete',[\App\Http\Controllers\TicketsController::class,'destroy']);
    });

Route::middleware('auth:api')->group(function () {
    Route::get('user', [\App\Http\Controllers\PassportController::class,'details']);
   // Route::resource('Ticket', [\App\Http\Controllers\TicketsController::class]);


});

/*Auth::routes();

 Route::get('/home', [App\Http\Controllers\PagesController::class, 'home'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\PagesController::class, 'home'])->name('home');*/
