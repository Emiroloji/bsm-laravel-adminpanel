<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DealController;




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


Route::prefix('crm')->group(function () {

    Route::resource('contacts', ContactController::class)->except(['create','show']);
    Route::get('contacts-table', [ContactController::class,'index'])->name('contacts.table');

    Route::resource('companies', CompanyController::class)->except(['create','show']);
    Route::get('companies-table', [CompanyController::class,'index'])->name('companies.table');


    Route::resource('deals', DealController::class)->except(['create','show']);
    Route::get('deals-table', [DealController::class,'index'])->name('deals.table');

    // 1) Önce custom rota – GET /crm/deals/kanban
    Route::get('deals/kanban', [DealController::class, 'kanban'])
         ->name('deals.kanban');

    // 2) Ardından status taşıma – PATCH /crm/deals/{id}/move
    Route::patch('deals/{id}/move', [DealController::class, 'move'])
         ->name('deals.move');

    // 3) En sonda resource tanımı
    Route::resource('deals', DealController::class);


    // Kanban, move ve resource tanımlarından önce:
    Route::get('deals/{id}/export-excel', [DealController::class,'exportExcel'])
         ->name('deals.export.excel');
    Route::get('deals/{id}/export-pdf',   [DealController::class,'exportPdf'])
         ->name('deals.export.pdf');

    Route::get('deals/{id}/view-proposal', [DealController::class, 'viewProposal'])
        ->name('deals.view.proposal');
});