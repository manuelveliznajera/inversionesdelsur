<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ImageController;
use App\Http\Livewire\Customers;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Loans;
use App\Http\Livewire\Rates;
use App\Http\Livewire\Users;
use App\Http\Livewire\Payments;
use App\Http\Livewire\Frecuencies;
use App\Http\Livewire\Reports\Report;
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

// route('customers')
// url('customers')
Route::get('frecuencias', Frecuencies::class)->name('frecuencias');

Route::get('clientes', Customers::class)->name('clientes');
Route::get('pagos', Payments::class)->name('pagos');

Route::get('rates', Rates::class)->name('rates');
Route::get('users', Users::class)->name('users');
Route::get('loans', Loans::class)->name('loans');
Route::get('pagos/{id}', Payments::class)->name('pagos');



Route::get('loans/lastpdf', [Loans::class, "createPDF"])->name('loans.lastpdf');



Route::get('/', [AuthenticatedSessionController::class,'create'])->middleware(['guest']);

Route::get('/dashboard', Dashboard::class)->middleware(['auth'])->name('dashboard');
Route::get('/reportes', Report::class)->middleware(['auth'])->name('reportes');


Route::post('/imagenes', [ImageController::class,'store'])->middleware(['auth'])->name('imagenes.store');


require __DIR__ . '/auth.php';
