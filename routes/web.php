<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\App;

/*
|--------------------------------------------------------------------------
| Localization
|--------------------------------------------------------------------------
*/

Route::get('locale/{locale}', function (string $locale) {

    if ( in_array($locale, ['ar', 'en'] ) ) {

        session()->put('locale', $locale);
        app()->setLocale($locale);

    } else {

        // set the default locale to english (en)
        session()->put('locale', 'en');
        app()->setLocale('en');
    }

    return redirect()->back();

})->name('set.locale');

/*
|--------------------------------------------------------------------------
| System routes
|--------------------------------------------------------------------------
*/

Route::view('/', 'index')->name('index');
Route::view('/info', 'support-info-page')->name('info');

Route::get('/create', [TicketController::class, 'create'])->name('ticket.create');
Route::post('/create', [TicketController::class, 'store'])->name('ticket.store');

Route::get('/ticket', [TicketController::class, 'show']);
Route::post('/ticket', [TicketController::class, 'show'])->name('ticket.searsh');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'executeLogin'])->name('executeLogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/registration', [AuthController::class, 'registration'])->name('registration');
Route::post('/register', [AuthController::class, 'registerUser'])->name('register');


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/password', [ProfileController::class, 'editPassword'])->name('password');
    Route::post('/password/update', [ProfileController::class, 'updatePassword'])->name('password.update');

    Route::get('/mytickets', [TicketController::class, 'index'])->name('user.tickets');

    Route::get('/PDF/{view}', [PdfController::class, 'generatePdf'])->name('generatePdf');
    Route::get('/PDF/{view}/{record}', [PdfController::class, 'generateUserTicketPdf'])->name('generateUserTicketPdf');
    
});


