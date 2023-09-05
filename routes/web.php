<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\MetricController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\Util\ConfigurationController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\KpiMetricController;
use App\Http\Controllers\DepartmentPartnerController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Auth::routes();

Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('home.dashboard');

Auth::routes();

//partners Routes
Route::resource('partners', PartnerController::class);


//departments Routes
Route::resource('departments', DepartmentController::class);

//configurations Routes
Route::resource('configurations', ConfigurationController::class);

//settings Routes
Route::resource('settings', SettingController::class);

//metrics Routes
Route::resource('metrics', MetricController::class);

//Units Routes
Route::resource('units', UnitController::class);

//Units Routes
Route::resource('profile', ProfileController::class);

//Progress
Route::resource('progress', ProgressController::class);

//Member
Route::resource('members', MemberController::class);


//Member
Route::resource('kpimetrics', KpiMetricController::class);

//Department_Partner

Route::resource('department_partners', DepartmentPartnerController::class);

