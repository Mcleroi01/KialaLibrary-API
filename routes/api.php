<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;



Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'v1',
    'as' => 'api.',
    'namespace' => 'Api\V1\Admin',
    'middleware' => ['auth:sanctum']
  ], function () {
    Route::get('/books/search', [BookController::class, 'search']);
    Route::get('/books/latest', [BookController::class, 'latest']);
    Route::get('/books/stats', [BookController::class, 'stats']);
    Route::get('/books/available', [BookController::class, 'availableBooks']);
    Route::get('/books/unavailable', [BookController::class, 'unavailableBooks']);
    Route::get('/books/genre/{genre}', [BookController::class, 'booksByGenre']);
    Route::get('/books/author/{author}', [BookController::class, 'booksByAuthor']);
    Route::get('/books/year/{year}', [BookController::class, 'booksByYear']);

    Route::apiResource('books', BookController::class);
    Route::apiResource('loans', LoanController::class);
  });
