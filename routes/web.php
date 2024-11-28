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
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    
    Route::get('/contacts', [App\Http\Controllers\ContactsController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contacts}', [App\Http\Controllers\ContactsController::class, 'show'])->name('contacts.show');
    Route::get('/contacts_create', [App\Http\Controllers\ContactsController::class, 'create'])->name('contacts.create');
    Route::post('/contacts', [App\Http\Controllers\ContactsController::class, 'store'])->name('contacts.store');
    Route::delete('/contacts/{contacts}', [App\Http\Controllers\ContactsController::class, 'destroy'])->name('contacts.destroy');
    
    Route::get('/contacts/{contacts}/edit', [App\Http\Controllers\ContactsController::class, 'edit'])->name('contacts.edit');
    Route::put('/contacts/{contacts}', [App\Http\Controllers\ContactsController::class, 'update'])->name('contacts.update');

    Route::get('/contacts_search', [App\Http\Controllers\ContactsController::class, 'search'])->name('contacts.search');
});