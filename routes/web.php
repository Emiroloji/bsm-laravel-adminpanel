<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DealController;

/*
|--------------------------------------------------------------------------
| GUEST ROUTES  (Login & Şifre Sıfırlama)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    // 1) Kök adres ve /login aynı giriş formuna düşer
    Route::view('/', 'auth.login')->name('login');
    Route::get('/login',  [LoginController::class, 'showLoginForm']);
    Route::post('/login', [LoginController::class, 'login']);

    // 2) Şifre sıfırlama (opsiyonel)
    Route::get ('/password/reset',         [ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email',         [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
    Route::get ('/password/reset/{token}', [ResetPasswordController::class,  'showResetForm'])->name('password.reset');
    Route::post('/password/reset',         [ResetPasswordController::class,  'reset'])->name('password.update');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES  (Panel içi)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /* -- Dashboard -- */
    Route::redirect('/home', '/dashboard');   // Eski linkleri düzelt
    Route::get('/dashboard', [DashboardController::class, 'index'])
         ->name('dashboard');

    /* -- TODO MODULE -- */
    Route::prefix('todo')->name('todo.')->group(function () {
        Route::get('/',                 [TodoController::class, 'index'])->name('index');
        Route::get('/table',            [TodoController::class, 'table'])->name('table');
        Route::get('/modal/create',     [TodoController::class, 'modalCreate'])->name('modal.create');
        Route::get('/modal/edit/{id}',  [TodoController::class, 'modalEdit'])->name('modal.edit');
        Route::post('/store',           [TodoController::class, 'store'])->name('store');
        Route::patch('/update/{id}',    [TodoController::class, 'update'])->name('update');
        Route::delete('/delete/{id}',   [TodoController::class, 'destroy'])->name('destroy');

        // Parçalı bileşenler
        Route::get('/components/table',  [TodoController::class, 'todoTableComponents'])->name('components.table');
        Route::get('/components/report', [TodoController::class, 'todoReportModal'])->name('components.report');
    });

    /* -- CRM MODULE -- */
    Route::prefix('crm')->name('crm.')->group(function () {

        // Contacts
        Route::resource('contacts', ContactController::class)->except(['create','show']);
        Route::get('contacts-table', [ContactController::class,'index'])->name('contacts.table');

        // Companies
        Route::resource('companies', CompanyController::class)->except(['create','show']);
        Route::get('companies-table', [CompanyController::class,'index'])->name('companies.table');

        // Deals
        Route::get('deals/{id}/export-excel',  [DealController::class,'exportExcel'])->name('deals.export.excel');
        Route::get('deals/{id}/export-pdf',    [DealController::class,'exportPdf'])->name('deals.export.pdf');
        Route::get('deals/{id}/view-proposal', [DealController::class,'viewProposal'])->name('deals.view.proposal');

        Route::get('deals/kanban',             [DealController::class,'kanban'])->name('deals.kanban');
        Route::patch('deals/{id}/move',        [DealController::class,'move'])->name('deals.move');

        Route::resource('deals', DealController::class)->except(['create','show']);
        Route::get('deals-table', [DealController::class,'index'])->name('deals.table');
    });

    /* -- Logout -- */
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});