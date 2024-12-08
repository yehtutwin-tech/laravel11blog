<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome');
});

// // Static Route
// Route::get('/articles', function() {
//     return 'Article List';
// });

// Route::get('/articles/detail', function() {
//     return 'Article Detail';
// })->route('articles.detail');

// // Dynamic Route
// Route::get('/articles/{id}', function($id) {
//     return 'Article ' . $id;
// });

// // Redirect
// Route::get('/articles/more', function() {
//     // return redirect('/articles/detail');
//     return redirect()->route('articles.detail');
// });

// Articles Route
// Route::resource('articles', ArticleController::class);
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/create', [ArticleController::class, 'create']);
Route::post('/articles', [ArticleController::class, 'store']);
Route::get('/articles/{id}', [ArticleController::class, 'show']);
Route::get('/articles/{id}/edit', [ArticleController::class, 'edit']);
Route::put('/articles/{id}', [ArticleController::class, 'update']);
Route::delete('/articles/{id}', [ArticleController::class, 'destroy']);

// Comments Route
Route::post('/comments', [CommentController::class, 'store']);
Route::get('/comments/{id}/delete', [CommentController::class, 'destroy']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::get('/download', function() {
//     return Storage::disk('public')->download('articles/1733165178.jpg');
// });

