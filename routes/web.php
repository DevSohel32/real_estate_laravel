<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Admin\AdminTypeController;
use App\Http\Controllers\Admin\AdminPackageController;
use App\Http\Controllers\Admin\AdminLocationController;

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/contact', [FrontController::class, 'contact'])->name('contact');
Route::get('/select_user', [FrontController::class, 'select_user'])->name('select_user');
Route::get('/pricing', [FrontController::class, 'pricing'])->name('pricing');

// User
Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile', [UserController::class, 'profile_submit'])->name('profile_submit');
});
Route::get('/registration', [UserController::class, 'registration'])->name('registration');
Route::post('/registration', [UserController::class, 'registration_submit'])->name('registration_submit');
Route::get('/registration-verify/{token}/{email}', [UserController::class, 'registration_verify'])->name('registration_verify');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'login_submit'])->name('login_submit');
Route::get('/forget-password', [UserController::class, 'forget_password'])->name('forget_password');
Route::post('/forget-password', [UserController::class, 'forget_password_submit'])->name('forget_password_submit');
Route::get('/reset-password/{token}/{email}', [UserController::class, 'reset_password'])->name('reset_password');
Route::post('/reset-password/{token}/{email}', [UserController::class, 'reset_password_submit'])->name('reset_password_submit');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');


// Agent sections

Route::middleware('agent')->prefix('agent')->group(function(){
    Route::get('/dashboard-agent', [AgentController::class, 'dashboard'])->name('agent_dashboard');
    Route::get('/profile', [AgentController::class, 'profile'])->name('agent_profile');
    Route::post('/profile', [AgentController::class, 'profile_submit'])->name('agent_profile_submit');
});
Route::prefix('agent')->group(function(){
Route::get('/registration', [AgentController::class, 'registration'])->name('agent_registration');
Route::post('/registration', [AgentController::class, 'registration_submit'])->name('agent_registration_submit');
Route::get('/registration-verify/{token}/{email}', [AgentController::class, 'registration_verify'])->name('agent_registration_verify');
Route::get('/login', [AgentController::class, 'login'])->name('agent_login');
Route::post('/login', [AgentController::class, 'login_submit'])->name('agent_login_submit');
Route::get('/forget-password', [AgentController::class, 'forget_password'])->name('agent_forget_password');
Route::post('/forget-password', [AgentController::class, 'forget_password_submit'])->name('agent_forget_password_submit');
Route::get('/reset-password/{token}/{email}', [AgentController::class, 'reset_password'])->name('agent_reset_password');
Route::post('/reset-password/{token}/{email}', [AgentController::class, 'reset_password_submit'])->name('agent_reset_password_submit');
Route::get('/logout', [AgentController::class, 'logout'])->name('agent_logout');

});



// Admin sections
Route::middleware('admin')->prefix('admin')->group(function(){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin_profile');
    Route::post('/profile', [AdminController::class, 'profile_submit'])->name('admin_profile_submit');
    Route::get('/packages/index', [AdminPackageController::class, 'index'])->name('admin_packages_index');
    Route::get('/package/create', [AdminPackageController::class, 'create'])->name('admin_package_create');
    Route::post('/package/store', [AdminPackageController::class, 'store'])->name('admin_package_store');
    Route::get('/package/edit/{id}', [AdminPackageController::class, 'edit'])->name('admin_package_edit');
    Route::put('/package/update', [AdminPackageController::class, 'update'])->name('admin_package_update');
    Route::delete('/package/delete/{id}', [AdminPackageController::class, 'destroy'])->name('admin_package_deleted');

    Route::get('/locations/index', [AdminLocationController::class, 'index'])->name('admin_locations_index');
    Route::get('/location/create', [AdminLocationController::class, 'create'])->name('admin_location_create');
    Route::post('/location/store', [AdminLocationController::class, 'store'])->name('admin_location_store');
    Route::get('/location/edit/{id}', [AdminLocationController::class, 'edit'])->name('admin_location_edit');
    Route::put('/location/update', [AdminLocationController::class, 'update'])->name('admin_location_update');
    Route::delete('/location/delete/{id}', [AdminLocationController::class, 'destroy'])->name('admin_location_deleted');

    Route::get('/types/index', [AdminTypeController::class, 'index'])->name('admin_types_index');
    Route::get('/type/create', [AdminTypeController::class, 'create'])->name('admin_type_create');
    Route::post('/type/store', [AdminTypeController::class, 'store'])->name('admin_type_store');
    Route::get('/type/edit/{id}', [AdminTypeController::class, 'edit'])->name('admin_type_edit');
    Route::put('/type/update', [AdminTypeController::class, 'update'])->name('admin_type_update');
    Route::delete('/type/delete/{id}', [AdminTypeController::class, 'destroy'])->name('admin_type_deleted');

});

Route::prefix('admin')->group(function(){
    Route::get('/', function () {return redirect()->route('admin_login');});
    Route::get('/login', [AdminController::class, 'login'])->name('admin_login');
    Route::post('/login', [AdminController::class, 'login_submit'])->name('admin_login_submit');
    Route::get('/forget-password', [AdminController::class, 'forget_password'])->name('admin_forget_password');
    Route::post('/forget-password', [AdminController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
    Route::get('/reset-password/{token}/{email}', [AdminController::class, 'reset_password'])->name('admin_reset_password');
    Route::post('/reset-password/{token}/{email}', [AdminController::class, 'reset_password_submit'])->name('admin_reset_password_submit');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin_logout');
});
