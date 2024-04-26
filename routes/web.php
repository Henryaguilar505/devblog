<?php

use App\Http\Controllers\blogController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\imagenController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Post;
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


Route::middleware('auth')->group(function () {
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


Route::view('/about', 'home.nosotros')->name('nosotros');
Route::get('/', [homeController::class, 'index'])->name('home.index');
Route::get('/blog', [blogController::class, 'index'])->name('blog.index');



Route::get('/dashboard', [PostController::class, 'index'])->middleware(['auth', 'verified'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->middleware(['auth', 'verified'])->name('posts.create');
Route::post('/posts/store', [PostController::class, 'store'])->middleware(['auth', 'verified'])->name('posts.store');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->middleware(['auth', 'verified'])->name('posts.edit');
Route::put('/posts/{post}/update', [PostController::class, 'update'])->middleware(['auth', 'verified'])->name('posts.update');
Route::get('/posts/{post}/show', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/saved', [PostController::class, 'saved'])->middleware(['auth', 'verified'])->name('posts.saved');




//comentarios
// Route::post('/posts/{post}', [ComentarioController::class, 'store'])->middleware(['auth', 'verified'])->name('comentario.store');



// Route::post('/imagenes', [imagenController::class, 'store'])->name('imagenes.store');
// Route::get('/imagenes/eliminar', [ImagenController::class, 'eliminar'])->name('imagenes.eliminar');


require __DIR__.'/auth.php';
