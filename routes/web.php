<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
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
    
    $articles = \App\Models\Article::where('user_id', auth()->id())->paginate();

    return view('dashboard', [ 'articles' => $articles ]);
})->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('/articles', ArticleController::class)
        ->only(['index', 'show']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    # ARTICLES
    Route::resource('/dashboard/articles', ArticleController::class)
            ->except(['index', 'show']);
});

require __DIR__.'/auth.php';
