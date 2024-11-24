<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TwoFAController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\SeatBookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminSeatController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AttendanceController;
use App\Notifications\NewBookingNotification;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\FaceBookController;
// use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\UserController;


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
    return view('index');
})->name('index');




Auth::routes(['verify' => true]);

Route::get('/user/home', [HomeController::class, 'index'])->name('user.home')->middleware('verified');
Route::get('/user/home', [DashboardController::class, 'showDashboard'])
    ->name('user.home')
    ->middleware('auth', 'verified');


Route::controller(TwoFAController::class)->group(function () {
    Route::get('two-factor-authentication', 'index')->name('2fa.index');
    Route::post('two-factor-authentication/store', 'store')->name('2fa.store');
    Route::get('two-factor-authentication/resend', 'resend')->name('2fa.resend');
});


Route::get('/user/fill-training-id', [UserController::class, 'showTrainingIdForm'])->name('user.fillTrainingId');
Route::post('/user/update-training-id', [UserController::class, 'updateTrainingId'])->name('user.updateTrainingId');

// Route::get('/auth/facebook', [SocialController::class, 'redirectToFacebook']);
// Route::get('/auth/facebook/callback', [SocialController::class, 'handleFacebookCallback']);
// Route::get('/auth/google', [SocialController::class, 'redirectToGoogle'])->name('google.login');
// Route::get('/auth/google/callback', [SocialController::class, 'handleGoogleCallback']);

Route::prefix('facebook')->name('facebook.')->group(function () {
    Route::get('auth', [FaceBookController::class, 'loginUsingFacebook'])->name('login');
    Route::get('callback', [FaceBookController::class, 'handleFacebookCallback'])->name('callback'); // Use handleFacebookCallback here
});

// Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');

// Route::get('google/callback', [LoginController::class, 'handleGoogleCallback']);
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Route::get('/login/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
// Route::get('/login/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Route::get('/login/google', [LoginController::class, 'redirectToGoogle'])->name('google.login');
// Route::get('/callback/google', [LoginController::class, 'handleGoogleCallback']);

// Route::get('login/google', [GoogleController::class, 'redirectToGoogle'])->name('login.google');
// Route::get('login/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('callback');

// Route for additional information form
Route::get('/auth/additional-info', [SocialController::class, 'showAdditionalInfoForm'])->name('additional.info');
Route::post('/auth/additional-info', [SocialController::class, 'storeAdditionalInfo']);


Route::get('/seat-booking', [SeatBookingController::class, 'showSeatBookingForm'])->name('seats.bookingForm');
Route::get('/seats/fetch', [SeatBookingController::class, 'fetchSeats'])->name('seats.fetch');
Route::post('/seats/checkAvailability', [SeatBookingController::class, 'checkAvailability'])->name('seats.checkAvailability');
Route::post('/seats/book', [SeatBookingController::class, 'bookSeat'])->name('seats.book');
Route::get('user/seats/index', [SeatBookingController::class, 'userbookSeatindex'])->name('user.seats.index');
Route::get('user/seats/create', [SeatBookingController::class, 'userbookcreate'])->name('user.seats.create');
Route::get('/user/seats/edit/{id}', [SeatBookingController::class, 'editBooking'])->name('user.seats.edit');
Route::put('/user/seats/update/{id}', [SeatBookingController::class, 'updateBooking'])->name('user.seats.update');
Route::delete('/user/seats/delete/{id}', [SeatBookingController::class, 'deleteBooking'])->name('user.seats.delete');
Route::get('/user/home', [SeatBookingController::class, 'index'])->name('user.home');

// Route::get('/booking-card', [SeatBookingController::class, 'showBookingCard'])->name('show.booking.card');
// Route::get('/booking-card', [SeatBookingController::class, 'showSeats'])->name('show.seats');
// Route::get('/fetch-seats', [SeatBookingController::class, 'getAvailableSeats'])->name('api.available.seats');
// Route::post('/check-availability', [SeatBookingController::class, 'checkAvailability'])->name('check.availability');
// Route::post('/book-seat', [SeatBookingController::class, 'bookSeat'])->name('book.seat');



Route::get('admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::get('admin/2fa', [AdminController::class, 'show2FAForm'])->name('admin.2fa');
Route::post('admin/2fa', [AdminController::class, 'verify2FA'])->name('admin.2fa.verify');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');


    Route::get('/admin/users', [AdminController::class, 'user_index'])->name('admin.users.index');
    Route::get('/admin/bookings', [AdminController::class, 'booking_index'])->name('admin.bookings.index');
    Route::post('/admin/bookings/attendance/{id}', [AdminController::class, 'markAttendance'])->name('admin.bookings.markAttendance');
    Route::get('/admin/users/{id}/pdf', [AdminController::class, 'generateUserPDF'])->name('admin.users.pdf');
    Route::get('/admin/users/{id}', [AdminController::class, 'showUser'])->name('admin.users.show');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.destroy');
  

    Route::get('admin/seats/create', [AdminSeatController::class, 'create'])->name('admin.seats.create');
    Route::post('admin/seats/store', [AdminSeatController::class, 'store'])->name('admin.seats.store');
    Route::get('admin/seats/index', [AdminSeatController::class, 'index'])->name('admin.seats.index');

    Route::get('admin/attendance/index', [AttendanceController::class, 'index'])->name('admin.attendance.index');
    Route::get('admin/attendance/getUserDetails', [AttendanceController::class, 'getUserDetails'])->name('attendance.getUserDetails');
    Route::get('admin/attendance/export', [AttendanceController::class, 'export'])->name('attendance.export');

    

    Route::get('/admin/profile', [AdminProfileController::class, 'show'])->name('admin.profile');
    Route::get('/admin/profile/edit', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
   
});
