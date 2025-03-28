<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// Main page, posts
Route::get('/', [PostController::class, 'index'])->name('home');

// Post
Route::get('posts/{post:slug}', [PostController::class, 'show']);
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

//Registro
Route::get('register', [RegisterController::class, 'create']);
Route::post('register', [RegisterController::class, 'store']);

//Login
Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');

//Logout
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

//Mailchimp
Route::post('newsletter', NewsletterController::class);

//Admin -> Los middleware son personalizados
// Admin
Route::post('admin/posts', [AdminPostController::class, 'store'])->middleware('administrator');
Route::get('admin/posts/create', [AdminPostController::class, 'create'])->middleware('administrator');
Route::get('admin/posts', [AdminPostController::class, 'index'])->middleware('administrator');
Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit'])->middleware('administrator');
Route::patch('admin/posts/{post}', [AdminPostController::class, 'update'])->middleware('administrator');
Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy'])->middleware('administrator');


//Todo lo de Admin se puede abreviar bastante, si usamos php artisan route:list veremos una lista de todas las rutas, como
//Admin utiliza practicamente todas las opciones RESTFUL, se podría hacer como abajo. ->except('show') lo que hace es eliminar
//esa funcion que no utilizamos, pero yo por ahora prefiero hacerlo de forma mas rudimentaria pero clara.

// Admin Section
//Route::middleware('can:admin')->group(function () {
//    Route::resource('admin/posts', AdminPostController::class)->except('show');
//});
