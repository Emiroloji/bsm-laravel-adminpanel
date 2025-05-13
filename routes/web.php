<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CrmDashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Animal\AnimalController;
use App\Http\Controllers\Animal\AnimalOwnerController;





/*-------------------------------------------------
|  GUEST  ➜  login & şifre sıfırlama
|-------------------------------------------------*/
Route::middleware('guest')->group(function () {
    Route::view('/', 'auth.login')->name('login');              // /  ve /login aynı form
    Route::get ('/login', [LoginController::class,'showLoginForm']);
    Route::post('/login', [LoginController::class,'login']);

    Route::get ('/password/reset',         [ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email',         [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
    Route::get ('/password/reset/{token}', [ResetPasswordController::class,  'showResetForm'])->name('password.reset');
    Route::post('/password/reset',         [ResetPasswordController::class,  'reset'])->name('password.update');
});

/*-------------------------------------------------
|  AUTHENTICATED  ➜  panel içi
|-------------------------------------------------*/
Route::middleware('auth')->group(function () {

    /* Dashboard */
    Route::redirect('/home', '/dashboard');
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    /* ===== TODO ===== */
    Route::prefix('todo')->name('todo.')->group(function () {
        Route::get('/',               [TodoController::class,'index'])->name('index');
        Route::get('/table',          [TodoController::class,'table'])->name('table');

        Route::get('/modal/create',   [TodoController::class,'modalCreate'])->name('modal.create');
        Route::get('/modal/edit/{id}',[TodoController::class,'modalEdit']) ->name('modal.edit');

        Route::post  ('/store',        [TodoController::class,'store'])->name('store');
        Route::patch ('/update/{id}',  [TodoController::class,'update'])->name('update');
        Route::delete('/delete/{id}',  [TodoController::class,'destroy'])->name('destroy');

        Route::get('/todo/components/todoTableComponents', [TodoController::class,'todoTableComponents'])
              ->name('components.todo-table');
        Route::get('/todo/components/todoReport',          [TodoController::class,'todoReportModal'])
              ->name('components.todo-report');
    });

    /* ===== CRM ===== */
    Route::prefix('crm')->group(function () {   // ←   name('crm.') silindi

        /* Contacts */
        Route::resource('contacts', ContactController::class)->except(['create','show']);
        Route::get('contacts-table',  [ContactController::class,'index'])->name('contacts.table');

        Route::resource('companies', CompanyController::class)->except(['create','show']);
        Route::get('companies-table', [CompanyController::class,'index'])->name('companies.table');

        Route::resource('deals', DealController::class)->except(['create','show']);
        Route::get('deals-table',     [DealController::class,'index'])->name('deals.table');

        Route::get ('deals/kanban',        [DealController::class,'kanban'])->name('deals.kanban');
        Route::patch('deals/{id}/move',    [DealController::class,'move'])  ->name('deals.move');

        Route::get('deals/{id}/export-excel',  [DealController::class,'exportExcel'])->name('deals.export.excel');
        Route::get('deals/{id}/export-pdf',    [DealController::class,'exportPdf'])  ->name('deals.export.pdf');
        Route::get('deals/{id}/view-proposal', [DealController::class,'viewProposal'])->name('deals.view.proposal');

        Route::get(
            'activities/{subjectType}/{subjectId}',
            [ActivityController::class, 'index']
        )->name('activities.index');

        // Yeni aktivite oluşturan POST rotası
        Route::post(
            'activities',
            [ActivityController::class, 'store']
        )->name('activities.store');

        // Aktivite güncelleme
        Route::patch(
            'activities/{activity}',
            [ActivityController::class, 'update']
        )->name('activities.update');

        // Aktivite silme
        Route::delete(
            'activities/{activity}',
            [ActivityController::class, 'destroy']
        )->name('activities.destroy');

        Route::get('/dashboard', [CrmDashboardController::class, 'index'])
         ->name('crm.dashboard');

    });


    Route::prefix('animal')->name('animal.')->group(function() {
        Route::get('/', [AnimalController::class, 'index'])->name('index');
        Route::get('/create', [AnimalController::class, 'create'])->name('create');
        Route::post('/', [AnimalController::class, 'store'])->name('store');
        Route::get('/{id}', [AnimalController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AnimalController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AnimalController::class, 'update'])->name('update');
        Route::delete('/{id}', [AnimalController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('animal-owner')->name('animal-owner.')->group(function(){
        Route::get('/', [AnimalOwnerController::class, 'index'])->name('index');
        Route::get('/create', [AnimalOwnerController::class, 'create'])->name('create');
        Route::post('/', [AnimalOwnerController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AnimalOwnerController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AnimalOwnerController::class, 'update'])->name('update');
        Route::delete('/{id}', [AnimalOwnerController::class, 'destroy'])->name('destroy');
    });


    Artisan::command('inspire', function () {
        $this->comment(Inspiring::quote());
    })->purpose('Display an inspiring quote');

    /* Logout (POST) */
    Route::post('/logout', [LoginController::class,'logout'])->name('logout');
    Route::get('notifications', [NotificationController::class,'index'])
         ->name('notifications.index');
    Route::get('notifications/{id}/read', [NotificationController::class,'markRead'])
         ->name('notifications.markRead');
});

/*-------------------------------------------------
|  Login sonrası varsayılan yönlendirme
|-------------------------------------------------*/