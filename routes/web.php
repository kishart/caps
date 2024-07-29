<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CompanyCRUDController;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('admin/ahome', [HomeController::class, 'adminHome'])->name('admin.ahome')->middleware('is_admin');

Route::get('uphotos', [HomeController::class, 'uphotos'])->middleware('auth', 'admin');
Route::get('appointlist', [HomeController::class, 'appointlist'])->middleware('auth', 'admin');
Route::get('msg', [HomeController::class, 'msg'])->middleware('auth', 'admin');

Route::get('calendar', [CalendarController::class, 'calendar'])->middleware('auth', 'admin');
Route::get('admin/calendar', [CalendarController::class, 'addCalendar']);
Route::post('save-calendar', [CalendarController::class, 'saveCalendar']);
Route::get('adminsidebar', [HomeController::class, 'adminsidebar'])->middleware('auth', 'admin');
Route::get('ucalen', [CalendarController::class, 'ucalen']);



Route::get('/setap', [AppointmentController::class, 'setap'])->name('setap');


Route::post('save-appoint', [AppointmentController::class, 'saveAppoint']);


Route::get('/appointlist', [AppointmentController::class, 'appointlist']);


Route::get('admin/editappoint/{id}', [AppointmentController::class, 'editAppointment']);
Route::post('admin/editappoint', [AppointmentController::class, 'updateAppointment']);

Route::get('admin/delete-appointment/{id}',[AppointmentController::class,'deleteAppointment']);

Route::get('admin/accepted/{id}', [AppointmentController::class, 'accepted']);
Route::get('admin/declined/{id}', [AppointmentController::class, 'declined']);
