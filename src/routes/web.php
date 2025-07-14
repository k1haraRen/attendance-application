<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManagerController;
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

Route::get('/login', [AuthController::class, 'userLoginForm'])->name('user_login.form');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'userRegisterForm'])->name('user_register.form');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('auth')->group(function () {
    Route::get('/', [AttendanceController::class, 'attendance'])->name('attendance');
    Route::post('/attendance/start', [AttendanceController::class, 'start'])->name('attendance.start');
    Route::post('/attendance/end', [AttendanceController::class, 'end'])->name('attendance.end');
    Route::post('/attendance/break', [AttendanceController::class, 'break'])->name('attendance.break');
    Route::post('/attendance/resume', [AttendanceController::class, 'resume'])->name('attendance.resume');

    Route::get('/attendance/list', [AttendanceController::class, 'attendanceList'])->name('attendance.list');
    Route::get('/attendances/{id}/edit', [AttendanceController::class, 'edit'])->name('attendance.edit');
    Route::post('/corrections/store', [AttendanceController::class, 'store'])->name('corrections.store');
    Route::get('/request/list', [AttendanceController::class, 'requestList'])->name('request.list');
});

Route::get('/admin/login', [AuthController::class, 'managerLoginForm'])->name('manager_login.form');
Route::post('/admin/login', [AuthController::class, 'managerLogin']);
Route::middleware('auth', 'admin')->group(function () {
    Route::get('/admin/attendance/list', [ManagerController::class, 'managerAdmin'])->name('manager.admin');
    Route::get('/admin/attendance/{id}', [ManagerController::class, 'applyApprove'])->name('apply.approve');
    Route::post('/admin/attendance/{id}/update', [ManagerController::class, 'update'])->name('admin.attendance.update');
    Route::get('/admin/staff/list', [ManagerController::class, 'staffList'])->name('staff.list');
    Route::get('/admin/attendance/staff/{id}', [ManagerController::class, 'staffEdit'])->name('staff.edit');
});

/*
->middleware(['auth', 'admin']);
*/