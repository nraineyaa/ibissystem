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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');//nama kat url link / nama function / nama panggil kat interface
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'loadDashboard'])->name('dashboard');


//====================================================== REGISTER CONTROLLER ======================================================
Route::get('/profile/{id}', [App\Http\Controllers\profileController::class, 'edit'])->name('profile');//send id to edit
Route::get('/editProfile/{id}', [App\Http\Controllers\profileController::class, 'update']);//edit profile 


//====================================================== ACTIVITY CONTROLLER ======================================================
Route::get('/activity', [App\Http\Controllers\ActivityController::class, 'index'])->name('activity');//to display activity records in table
Route::get('/activity/ViewActivity', [App\Http\Controllers\ActivityController::class, 'loadActv'])->name('activity/ViewActv');//to display activity details
Route::get('/activity/EditActivity', [App\Http\Controllers\ActivityController::class, 'editActv'])->name('activity/EditActv');//to edit activity record
Route::get('/activity/AddNewActivity', [App\Http\Controllers\ActivityController::class, 'addActv'])->name('activity/AddActv');//to view the new activity form
Route::post('/activity', [App\Http\Controllers\ActivityController::class, 'addNewActivity'])->name('addNewActivity');//to add new activity record
Route::delete('deleteActivity/{id}', [App\Http\Controllers\ActivityController::class, 'deleteActivity'])->name('deleteActivity');//to delete activity record
Route::post('updateActivity/{id}', [App\Http\Controllers\ActivityController::class, 'updateActivity'])->name('updateActivity');//to update activity record
Route::get('activityDetails/{id}', [App\Http\Controllers\ActivityController::class, 'activityDetails'])->name('activityDetails');//to view activity record in detail
Route::get('/viewActvProposal', [App\Http\Controllers\ActivityController::class, 'viewActvProposal'])->name('viewActvProposal');//to view activity proposal
Route::post('/searchActvP', [App\Http\Controllers\ActivityController::class, 'searchActvP'])->name('searchActvP');//to search activity
Route::get('/clearFilterActivity', [App\Http\Controllers\ActivityController::class, 'clearFilter'])->name('clearFilterActivity');//to clear search activity
Route::post('joinActivity/{id}', [App\Http\Controllers\ActivityController::class, 'joinActivity'])->name('joinActivity');//to join available activity
Route::get('/listJoinedActv', [App\Http\Controllers\ActivityController::class, 'listJoinedActv'])->name('listJoinedActv');//to display joined activity
Route::post('/searchListActv', [App\Http\Controllers\ActivityController::class, 'searchListActv'])->name('searchListActv');//to search activity info
Route::get('/clearFilterListActivity', [App\Http\Controllers\ActivityController::class, 'clearFilterListActivity'])->name('clearFilterListActivity');//to clear search activity info
Route::get('/activity/ActivityApproval', [App\Http\Controllers\ActivityController::class, 'planActv'])->name('activity/PlanActv');
//Route::patch('/activity/update/{activity}', [App\Http\Controllers\ActivityController::class, 'update'])->name('update');
//Route::get('/updateActivity/{id}', [App\Http\Controllers\ActivityController::class, 'updateActivity'])->name('updateActivity');
Route::get('/upload-file', [App\Http\Controllers\FileUpload::class, 'createForm']);
Route::post('/upload-file', [App\Http\Controllers\FileUpload::class, 'fileUpload'])->name('fileUpload');


//====================================================== BB CONTROLLER ======================================================


Route::controller(App\Http\Controllers\UserController::class)->group(function(){ 
    Route::get('/userList', 'index')->name('userList.page');
    Route::get('/registerUser', 'registerUser')->name('registerUser.page');
    Route::post('/addUser', 'addUser')->name('addUser');
    Route::delete('/deleteUser/{id}', 'deleteUser')->name('deleteUser');
    Route::get('/editUser/{id}', 'editUser')->name('editUser');
    Route::post('/updateUser/{id}', 'updateUser')->name('updateUser');
    Route::post('/updateAvatar', 'updateAvatar')->name('updateAvatar');
    Route::post('/updateProfile/{id}', 'updateProfile')->name('updateProfile');
    Route::post('/updatePassword', 'updatePassword')->name('updatePassword');
    Route::get('/employeeRec', 'employeeRec')->name('employeeRec');
    Route::get('/bankInfo', 'bankInfo')->name('bankInfo');
});
