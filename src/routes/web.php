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
Route::middleware('auth')->group(function () {
    Route::get('/', [AttendanceController::class, 'attendance'])->name('attendance');
    Route::get('/attendance/list', [AttendanceController::class, 'attendanceList'])->name('attendance.list');
    Route::get('/request/list', [AttendanceController::class, 'requestList'])->name('request.list');
});

Route::get('/admin/login', [AuthController::class, 'managerLoginForm'])->name('manager_login.form');
Route::post('/admin/login', [AuthController::class, 'managerLogin']);


/*
->middleware(['auth', 'admin']);
*/