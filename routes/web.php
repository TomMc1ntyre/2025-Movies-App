<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route :: get('/movies', [App\Http\Controllers\MovieController::class, 'index']) -> name('movies.index');
Route :: get('/movies/create', [App\Http\Controllers\MovieController::class, 'create']) -> name('movies.create');
Route :: post('/movies', [App\Http\Controllers\MovieController::class, 'store']) -> name('movies.store');
Route :: get('/movies/{movie}', [App\Http\Controllers\MovieController::class, 'show']) -> name('movies.show');

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

require __DIR__.'/auth.php';
