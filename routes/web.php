<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;


Route::get('/', function () {
    return view('welcome');

});


Route::prefix('todo')->group(function () {
    Route::get('/', [TodoController::class, 'index'])->name('todo.index');
    Route::post('/store', [TodoController::class, 'store'])->name('todo.store');
    Route::post('/update/{id}', [TodoController::class, 'update'])->name('todo.update');
    Route::delete('/delete/{id}', [TodoController::class, 'destroy'])->name('todo.destroy');
});