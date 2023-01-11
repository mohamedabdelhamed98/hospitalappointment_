<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

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

Route::get('/',[ProjectController::class, 'getAllDepartment'])->name('home');
Route::POST('/showappointment',[ProjectController::class, 'showappointment'])->name('showappointment')->middleware('auth');
Route::POST('/bookappointment',[ProjectController::class, 'bookappointment'])->name('bookappointment')->middleware('auth');

Route::get('/mybookings',[ProjectController::class, 'mybookings'])->name('mybookings')->middleware('auth');

Route::POST('/cancelbooking',[ProjectController::class, 'cancelbooking'])->name('cancelbooking')->middleware('auth');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
