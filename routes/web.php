<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestPhotoController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('uphotos', [HomeController::class, 'uphotos'])->middleware('auth', 'admin');
//Route::get('/view-photos', [TestPhotoController::class, 'viewPhotos'])->name('view-photos');

 Route::get('/view-photos', [TestPhotoController::class, 'viewPhotos']);
 Route::get('/admin/home', [AppointmentController::class, 'adminHome'])->name('admin.ahome');

Route::get('appointlist', [AppointmentController::class, 'appointlist'])->middleware('auth', 'admin');



// Routes for Calendar
Route::get('calendar', [CalendarController::class, 'calendar'])->middleware('auth', 'admin');
Route::get('admin/calendar', [CalendarController::class, 'addCalendar'])->middleware('auth', 'admin');

Route::post('save-calendar', [CalendarController::class, 'saveCalendar'])->name('admin.calendar');

Route::get('ucalen', [CalendarController::class, 'ucalen'])->middleware('auth');

Route::get('schedulelist', [CalendarController::class, 'schedulelist'])->middleware('auth')->name('admin.schedulelist');
// Schedule routes
// Route::get('/admin/schedules/{id}/editcalendar', [CalendarController::class, 'edit'])->name('admin.edit');

Route::get('admin/editcalendar/{id}', [CalendarController::class, 'editCalendar'])->name('admin.editcalendar');
Route::put('/admin/update/{id}', [CalendarController::class, 'updateCalendar'])->name('admin.updatecalendar');

Route::get('add-calendar', function () {
    return view('admin.add-calendar-event');
});



Route::delete('/admin/schedules/{id}', [CalendarController::class, 'destroy'])->name('admin.schedules.delete');


Route::get('adminsidebar', [HomeController::class, 'adminsidebar'])->middleware('auth', 'admin');




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


// Paid appointment route
Route::get('admin/paid/{id}', [AppointmentController::class, 'paid'])->name('admin.paid');


// User payment display route
Route::get('user/payment/{id}', [AppointmentController::class, 'showDownpayment'])->name('user.payment');


// Route to show the form
Route::post('/move-to-archived', [AppointmentController::class, 'moveToArchived']);

Route::middleware(['auth'])->get('archived', [AppointmentController::class, 'archived'])->name('archived');
Route::middleware(['auth'])->get('setap', [AppointmentController::class, 'setap'])->name('setap');
Route::middleware(['auth'])->get('payment', [AppointmentController::class, 'payment'])->name('payment');



// Route to handle form submission
Route::post('save-appoint', [AppointmentController::class, 'saveAppoint']);

// Route to show the user's appointments
Route::get('myappoint', [AppointmentController::class, 'myappoint'])->name('appointments.myappoint');


Route::post('/request-feedback/{id}', [AppointmentController::class, 'requestFeedback'])->name('request.feedback');
Route::get('/feedback-form/{id}', [AppointmentController::class, 'showFeedbackForm'])->name('feedback.form');
Route::post('/submit-feedback/{id}', [AppointmentController::class, 'submitFeedback'])->name('submit.feedback');





Route::get('listappoint', [HomeController::class, 'listappoint'])->middleware('auth', 'admin');


Route::get('/admin/get-feedback/{id}', [AppointmentController::class, 'getFeedback'])->name('get.feedback');
Route::get('/myappointments', [AppointmentController::class, 'myAppointments'])->name('user.myappoint');

Route::get('/profile', [HomeController::class, 'editProfile'])->name('profile.edit');
Route::put('/profile', [HomeController::class, 'updateProfile'])->name('profile.update');



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





Route::match(['get', 'post'], '/admin/upload-photos/{photosId?}', [TestPhotoController::class, 'managePhotos'])->name('admin.upload-photos');


Route::get('show-photos', [TestPhotoController::class, 'showUploadedPhotos'])->name('photos.view');

Route::post('/post-comment/{file}', [TestPhotoController::class, 'postComment'])->name('post-comment');

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





Route::post('/payment/store/{appointmentId}', [AppointmentController::class, 'storePayment'])->name('payment.store');


Route::post('/contact', [ContactController::class, 'store'])->middleware('auth')->name('contact.store');

Route::get('/msg', [ContactController::class, 'msgview'])
    ->middleware(['auth', 'admin']);
    
Route::post('admin/photos/{photoId}/update', [TestPhotoController::class, 'updatePhoto'])->name('admin.update-photo');

Route::delete('admin/delete-photos/{id}', [TestPhotoController::class, 'deletePhotos'])->name('admin.delete-photo');

Route::get('admin/editphotos/{id}', [TestPhotoController::class, 'editPhotos'])->name('admin.editphotos');




Route::get('admin/editphotos/{id}', [TestPhotoController::class, 'editPhotos'])->name('editphotos.get');
Route::post('admin/editphotos/{id}', [TestPhotoController::class, 'updatePhotos'])->name('editphotos.update');