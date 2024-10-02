<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FileController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/photos', [PostController::class, 'photos'])->name('photos');

Route::get('admin/ahome', [AppointmentController::class, 'adminHome'])->name('admin.ahome')->middleware('is_admin');

Route::get('uphotos', [HomeController::class, 'uphotos'])->middleware('auth', 'admin');
Route::get('appointlist', [AppointmentController::class, 'appointlist'])->middleware('auth', 'admin');
Route::get('msg', [HomeController::class, 'msg'])->middleware('auth', 'admin');

Route::get('calendar', [CalendarController::class, 'calendar'])->middleware('auth', 'admin');
Route::get('admin/calendar', [CalendarController::class, 'addCalendar']);
Route::post('save-calendar', [CalendarController::class, 'saveCalendar']);
Route::get('adminsidebar', [HomeController::class, 'adminsidebar'])->middleware('auth', 'admin');
Route::get('ucalen', [CalendarController::class, 'ucalen']);



Route::get('admin/editappoint/{id}', [AppointmentController::class, 'editAppointment']);
Route::post('admin/editappoint', [AppointmentController::class, 'updateAppointment']);

Route::get('admin/delete-appointment/{id}',[AppointmentController::class,'deleteAppointment']);

Route::get('admin/accepted/{id}', [AppointmentController::class, 'accepted']);
Route::get('admin/declined/{id}', [AppointmentController::class, 'declined']);




// Route to show the form

Route::middleware(['auth'])->get('setap', [AppointmentController::class, 'setap'])->name('setap');
Route::middleware(['auth'])->get('payment', [AppointmentController::class, 'payment'])->name('payment');



// Route to handle form submission
Route::post('save-appoint', [AppointmentController::class, 'saveAppoint']);

// Route to show the user's appointments
Route::get('myappoint', [AppointmentController::class, 'myappoint'])->name('appointments.myappoint');

Route::middleware(['auth'])->group(function () {
    Route::get('/show_post', [PostController::class, 'show_post']);
});


Route::post('add_photo', [PostController::class, 'add_photo'])->name('add_photo');
Route::get('/delete_post/{id}', [PostController::class, 'delete_post'])->name('delete_post');
Route::get('/edit_post/{id}', [PostController::class, 'edit_post'])->name('edit_post');
Route::post('/update_post/{id}', [PostController::class, 'update_post'])->name('update_post');


Route::post('/request-feedback/{id}', [AppointmentController::class, 'requestFeedback'])->name('request.feedback');
Route::get('/feedback-form/{id}', [AppointmentController::class, 'showFeedbackForm'])->name('feedback.form');
Route::post('/submit-feedback/{id}', [AppointmentController::class, 'submitFeedback'])->name('submit.feedback');





Route::get('listappoint', [HomeController::class, 'listappoint'])->middleware('auth', 'admin');


Route::get('/admin/get-feedback/{id}', [AppointmentController::class, 'getFeedback'])->name('get.feedback');
Route::get('/myappointments', [AppointmentController::class, 'myAppointments'])->name('user.myappoint');

Route::get('/profile', [HomeController::class, 'editProfile'])->name('profile.edit');
Route::put('/profile', [HomeController::class, 'updateProfile'])->name('profile.update');


Route::get('storage', [HomeController::class, 'storage'])->middleware('auth', 'admin');
Route::resource('files', FileController::class);



Route::get('umsg', [HomeController::class, 'umsg'])->middleware('auth');

Route::get('contact', [HomeController::class, 'contact'])->middleware('auth');


// Route to display messages for a specific appointment
Route::get('/appointment/{id}/messages', [AppointmentController::class, 'showMessages'])->name('show.messages');

// Route to send a message for a specific appointment
Route::post('/appointment/{id}/messages', [AppointmentController::class, 'sendMessage'])->name('send.message');
Route::post('/send-message/{id}', [AppointmentController::class, 'sendMessage'])->name('send.message');


Route::get('calendartest', [HomeController::class, 'calendartest'])->middleware('auth');

Route::get('uphotostest', [HomeController::class, 'uphotostest'])->middleware('auth');






Route::post('save-uphotos', [FileController::class, 'saveUphotos']);