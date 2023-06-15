<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditCalendarController;
use App\Http\Controllers\ViewCalendarController;


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
    if ($user = Auth::user()) {
        //if login
        return redirect('/dashboard');
    } else {
        //if not login
        return redirect('login');
    }
});

// all authentication route here
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); //nama kat url link / nama function / nama panggil kat interface
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'loadDashboard'])->name('dashboard');


//====================================================== REGISTER CONTROLLER ======================================================
Route::get('/profile/{id}', [App\Http\Controllers\profileController::class, 'edit'])->name('profile'); //send id to edit
Route::post('/editProfile/{id}', [App\Http\Controllers\profileController::class, 'update']); //edit profile 
Route::get('/updateUserList/{id}', [App\Http\Controllers\UserController::class, 'updateUserList']); //edit profile 

//====================================================== User CONTROLLER ======================================================


Route::controller(App\Http\Controllers\UserController::class)->group(function () {
    Route::get('/userList', 'index')->name('userList.page');
    Route::get('/registerUser', 'registerUser')->name('registerUser.page');
    Route::post('/addUser', 'addUser')->name('addUser');
    Route::delete('/deleteUser/{id}', 'deleteUser')->name('deleteUser');
    Route::get('/editUser/{id}', 'editUser')->name('editUser');
    Route::post('/updateAvatar', 'updateAvatar')->name('updateAvatar');
    Route::post('/updateProfile/{id}', 'updateProfile')->name('updateProfile');
    Route::post('/updatePassword', 'updatePassword')->name('updatePassword');
    Route::get('/employeeRec', 'employeeRec')->name('employeeRec');
});

//====================================================== Maintenance & Services CONTROLLER ======================================================

Route::controller(App\Http\Controllers\MaintenanceController::class)->group(function () {
    Route::get('/maintenance', 'index')->name('maintenance.page');
    Route::get('/reportForm', 'reportForm')->name('reportForm');
    Route::get('/jobForm', 'jobForm')->name('jobForm');
    Route::post('/addJob', 'addJob')->name('addJob');
    Route::post('/addReport', 'addReport')->name('addReport');
    Route::get('/jobInfo/{id}', 'jobInfo')->name('jobInfo');
    Route::get('/updateInfo/{id}', 'updateInfo')->name('updateInfo');
    Route::get('/editJob/{id}', 'editJob')->name('editJob');
    Route::get('/updateJob/{id}', 'updateJob')->name('updateJob');
});


//====================================================== Finance CONTROLLER ======================================================

Route::controller(App\Http\Controllers\FinanceController::class)->group(function () {
    Route::get('/claim', 'index')->name('claim.page');
    Route::post('/addClaim', 'addClaim')->name('addClaim');
    Route::get('/editClaim/{id}', 'editClaim')->name('editClaim');
    Route::get('/updateClaim/{id}', 'updateClaim')->name('updateClaim');
    Route::get('chart', 'chart')->name('chart');;
});

//====================================================== Invoice CONTROLLER ======================================================

Route::controller(App\Http\Controllers\InvoiceController::class)->group(function () {
    Route::get('/invoice', 'index')->name('invoice.page');
    Route::get('/invoiceForm', 'invoiceForm')->name('invoiceForm');
    Route::delete('/deleteItem/{id}', 'deleteItem')->name('deleteItem');
    Route::post('/addItem', 'addItem')->name('addItem');
    Route::post('/addInvoice', 'addInvoice')->name('addInvoice');
    Route::get('/addItemForm', 'addItemForm')->name('addItemForm');
});

//====================================================== Attendance CONTROLLER ======================================================

Route::controller(App\Http\Controllers\AttendanceController::class)->group(function () {
    Route::get('/attendance', 'attendance')->name('attendance.page');
    Route::post('/checkIn','checkIn')->name('checkIn');
    Route::get('/checkOut/{id}','checkOut')->name('checkOut');
});