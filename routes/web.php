<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CalendarController;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('admin/ahome', [HomeController::class, 'adminHome'])->name('admin.ahome')->middleware('is_admin');

Route::get('uphotos', [HomeController::class, 'uphotos'])->middleware('auth', 'admin');
Route::get('booklist', [HomeController::class, 'booklist'])->middleware('auth', 'admin');
Route::get('msg', [HomeController::class, 'msg'])->middleware('auth', 'admin');


Route::get('calendar', [CalendarController::class, 'calendar'])->middleware('auth', 'admin');


Route::get('admin/calendar',[CalendarController::class,'addCalendar']);

Route::post('save-calendar',[CalendarController::class,'saveCalendar']);

Route::get('adminsidebar', [HomeController::class, 'adminsidebar'])->middleware('auth', 'admin');


Route::get('ucalen', [CalendarController::class, 'ucalen']);

Route::get('/setap', [AppointmentController::class, 'setap'])->name('setap');


Route::post('save-appoint',[AppointmentController::class,'saveAppoint']);