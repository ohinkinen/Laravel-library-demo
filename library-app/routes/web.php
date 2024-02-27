<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/libraries', [LibraryController::class, 'getLibraries'])->name('libraries');

Route::get('/libraries/{library_id}', [LibraryController::class, 'getLibrary']);

Route::get('/books', [BookController::class, 'getBooks'])->name('books');

Route::get('/books/{book_id}', [BookController::class, 'getBook']);

Route::middleware('admin')->group(function () {
    Route::post('/libraries', [LibraryController::class, 'addLibrary'])->name('addLibrary');
    Route::put('/libraries/{library_id}', [LibraryController::class, 'editLibrary'])->name('editLibrary');
    Route::delete('/libraries', [LibraryController::class, 'deleteLibrary'])->name('deleteLibrary');
    
    Route::post('/books', [BookController::class, 'addBook'])->name('addBook');
    Route::put('/books/{book_id}', [BookController::class, 'editBook'])->name('editBook');
    Route::delete('/books', [BookController::class, 'deleteBook'])->name('deleteBook');
});

require __DIR__.'/auth.php';
