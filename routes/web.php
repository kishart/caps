<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestPhotoController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('uphotos', [HomeController::class, 'uphotos'])->middleware('auth', 'admin');



Route::get('admin/ahome', [AppointmentController::class, 'adminHome'])->name('admin.ahome');
Route::get('appointlist', [AppointmentController::class, 'appointlist'])->middleware('auth', 'admin');
Route::get('msg', [HomeController::class, 'msg'])->middleware('auth', 'admin');

Route::get('calendar', [CalendarController::class, 'calendar'])->middleware('auth', 'admin');
Route::get('admin/calendar', [CalendarController::class, 'addCalendar']);
Route::post('save-calendar', [CalendarController::class, 'saveCalendar']);
Route::get('adminsidebar', [HomeController::class, 'adminsidebar'])->middleware('auth', 'admin');
Route::get('ucalen', [CalendarController::class, 'ucalen']);



// Edit appointment routes
Route::get('admin/editappoint/{id}', [AppointmentController::class, 'editAppointment'])->name('admin.edit');
Route::post('admin/editappoint', [AppointmentController::class, 'updateAppointment'])->name('admin.update');

// Delete appointment route
Route::get('admin/delete-appointment/{id}', [AppointmentController::class, 'deleteAppointment'])->name('admin.delete');

// Show appointment details route
Route::get('admin/accepted/{id}', [AppointmentController::class, 'showDownpayment'])->name('admin.accepted.show');


// Show appointment details route
Route::get('user/payment/{id}', [AppointmentController::class, 'showUserDownpayment'])->name('user.downpayment.show');



// Accept appointment route with down payment
Route::post('admin/accepted/{id}', [AppointmentController::class, 'accepted'])->name('admin.accepted.accept');

// Decline appointment route
Route::get('admin/declined/{id}', [AppointmentController::class, 'declined'])->name('admin.declined');

// User payment display route
Route::get('user/payment/{id}', [AppointmentController::class, 'showDownpayment'])->name('user.payment');


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



Route::post('/admin/store-payment/{appointmentId}', [AppointmentController::class, 'storePayment'])->name('storePayment');
Route::get('/admin/payments/{appointmentId}', [AppointmentController::class, 'viewPayments'])->name('viewPayments');





Route::get('upload-photos', function () {
    return view('/admin/upload-photos');
});


Route::post('upload-photos', [TestPhotoController::class, 'upload'])->name('photos.upload');
Route::get('show-photos', [TestPhotoController::class, 'showUploadedPhotos'])->name('photos.view');
Route::get('/upload-photos', [TestPhotoController::class, 'showForm'])->name('form.show');

// Route::post('/post-comment/{file}', [TestPhotoController::class, 'postComment'])->name('post-comment');

Route::post('/comment/{photoId}', [TestPhotoController::class, 'postComment'])->name('post-comment');

Route::get('/uphotostest', [FileController::class, 'create'])->middleware('auth');

// web.php (Routes)
Route::get('/create-uphotos', [FileController::class, 'create'])->name('create-uphotos');
Route::post('/save-uphotos', [FileController::class, 'saveUphotos'])->name('save-uphotos');


Route::get('/viewp', [FileController::class, 'showPhotos'])->name('view-photos');

Route::get('files/{id}/delete', [FileController::class, 'destroy'])->name('delete-file');
Route::post('/post-comment/{file}', [FileController::class, 'postComment'])->name('post-comment');






// Removed duplicate route definition

Route::get('/create-photos', [FileController::class, 'cphotos'])->name('create-photos');
Route::post('/save-photos', [FileController::class, 'savePhotos'])->name('save-photos');




Route::get('nav', [HomeController::class, 'navbar'])->middleware('auth');




Route::post('/appointments/store', [AppointmentController::class, 'storeAppointment'])->name('appointments.store');
Route::get('/admin/ahome/{appointmentId}', [AppointmentController::class, 'viewPayments'])->name('payments.ahome');
// web.php

Route::get('/photo/edit/{id}', [TestPhotoController::class, 'edit'])->name('photo.edit');
Route::put('/photo/update/{id}', [TestPhotoController::class, 'update'])->name('photo.update');
Route::delete('/photo/delete/{id}', [TestPhotoController::class, 'destroy'])->name('photo.delete');

Route::get('/admin/photo_list', [TestPhotoController::class, 'list'])->name('photo.list');




Route::post('/payment/store/{appointmentId}', [AppointmentController::class, 'storePayment'])->name('payment.store');


Route::get('/ucalen', [CalendarController::class, 'viewUserCalendar'])->name('user.ucalen');
