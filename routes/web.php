<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/events', [App\Http\Controllers\EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [App\Http\Controllers\EventController::class, 'create'])->name('events.create');
    Route::post('/events', [App\Http\Controllers\EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}', [App\Http\Controllers\EventController::class, 'show'])->name('events.show');
    Route::get('/events/{event}/edit', [App\Http\Controllers\EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [App\Http\Controllers\EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [App\Http\Controllers\EventController::class, 'destroy'])->name('events.destroy');

    Route::get('/events/{event}/registrations', [App\Http\Controllers\RegistrationController::class, 'index'])->name('registrations.index');
    Route::get('/events/{event}/registrations/create', [App\Http\Controllers\RegistrationController::class, 'create'])->name('registrations.create');
    Route::post('/events/{event}/registrations', [App\Http\Controllers\RegistrationController::class, 'store'])->name('registrations.store');
    Route::get('/events/{event}/registrations/{registration}', [App\Http\Controllers\RegistrationController::class, 'show'])->name('registrations.show');
    Route::get('/events/{event}/registrations/{registration}/edit', [App\Http\Controllers\RegistrationController::class, 'edit'])->name('registrations.edit');
    Route::put('/events/{event}/registrations/{registration}', [App\Http\Controllers\RegistrationController::class, 'update'])->name('registrations.update');
    Route::delete('/events/{event}/registrations/{registration}', [App\Http\Controllers\RegistrationController::class, 'destroy'])->name('registrations.destroy');
});

// for Calendar
Route::get('/event_calendar', [App\Http\Controllers\EventCalendarController::class, 'event_calendar'])->name('event_calendar');
// Route::get('/calendar-data', [App\Http\Controllers\EventCalendarController::class, 'getCalendarData']);
