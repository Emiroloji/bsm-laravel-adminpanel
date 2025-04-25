<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;



Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');
Route::prefix('todo')->group(function () {
    Route::get('/', [TodoController::class, 'index'])->name('todo.index');
    Route::get('/table', [TodoController::class, 'table'])->name('todo.table');
    Route::get('/modal/create', [TodoController::class, 'modalCreate'])->name('todo.modal.create');
    Route::get('/modal/edit/{id}', [TodoController::class, 'modalEdit'])->name('todo.modal.edit');
    Route::post('/store', [TodoController::class, 'store'])->name('todo.store');
    Route::patch('/update/{id}', [TodoController::class, 'update'])->name('todo.update');
    Route::delete('/delete/{id}', [TodoController::class, 'destroy'])->name('todo.destroy');
    Route::get('/todo/components/todoTableComponents', [TodoController::class, 'todoTableComponents'])->name('todo.components.todo-table');
    Route::get('/todo/components/todoReport', [TodoController::class, 'todoReportModal'])->name('todo.components.todo-report');
});