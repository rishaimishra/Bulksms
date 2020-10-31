<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

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


// Route::resource('/admin/users', App\Http\Controllers\Admin\UsersController::class)->except([
//     'create', 'store', 'show'
// ]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function () {
    Route::resource('/users', App\Http\Controllers\Admin\UsersController::class)->except([
        'create', 'store', 'show'
    ]);
    Route::get('/users/import', [App\Http\Controllers\ImportController::class, 'show'])->name('import.show');
    Route::post('/users/import', [App\Http\Controllers\ImportController::class, 'store'])->name('import.store');

    Route::resource('/contacts', App\Http\Controllers\ContactController::class)->except([
        'create', 'index','show','edit'
    ]);

    Route::get('/users/delete/{id}', [App\Http\Controllers\ContactController::class, 'destroying'])->name('import.delete');
    Route::post('/users/send', [App\Http\Controllers\SendController::class, 'sendsms'])->name('import.send');
    Route::get('/users/send/sms', [App\Http\Controllers\SendController::class, 'index'])->name('import.form');
    Route::get('/users/getnumber/{id}', [App\Http\Controllers\SendController::class, 'getNumber'])->name('import.number');


    Route::get('/users/send/email', [App\Http\Controllers\MailController::class, 'index'])->name('import.form.mail');
    Route::get('/users/getemail/{id}', [App\Http\Controllers\MailController::class, 'getEmail'])->name('getemail');


    Route::any('users/sendmail', [App\Http\Controllers\MailController::class, 'sendMail'])->name('import.mail');


});