<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Route;

Route::post('/books', [BooksController::class , 'store']);
Route::patch('/books/{bookId}', [BooksController::class , 'update']);
Route::delete('/books/{bookId}', [BooksController::class , 'delete']);

Route::post('/author', [AuthorController::class , 'create']);