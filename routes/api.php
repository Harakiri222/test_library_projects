<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::post('/mainpage/books', [BookController::class, 'addBook']);
Route::put('/mainpage/books/{id}', [BookController::class, 'updateBook']);
Route::delete('/mainpage/books/{id}', [BookController::class, 'deleteBook']);
Route::get('/mainpage/books', [BookController::class, 'getBooks']);
