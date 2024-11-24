<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

// getting all the todos
Route::get("/", [TodoController::class, 'index']);

// adding new todos
Route::post('/', [TodoController::class, 'store'])->middleware(['auth-guard']);

// searching
Route::get("/find", [TodoController::class, 'find']);

// summary
Route::get('/summary', [TodoController::class, 'summary']);

// getting single todo
Route::get('/{id}', [TodoController::class, 'show']);

// updating todo
Route::patch('/{id}', [TodoController::class, 'update']);

// deleting todo
Route::delete('/{id}', [TodoController::class, 'destroy']);

// marking complete a todo
Route::patch('/{id}/complete', [TodoController::class, 'markComplete']);
