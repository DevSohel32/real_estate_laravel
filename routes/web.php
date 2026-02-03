<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Admin\AdminTypeController;
use App\Http\Controllers\Admin\AdminAgentController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminAmenityController;
use App\Http\Controllers\Admin\AdminPackageController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminLocationController;
use App\Http\Controllers\Admin\AdminPropertyController;

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/contact', [FrontController::class, 'contact'])->name('contact');
Route::get('/select_user', [FrontController::class, 'select_user'])->name('select_user');
Route::get('/pricing', [FrontController::class, 'pricing'])->name('pricing');
Route::get('/property/{slug}', [FrontController::class, 'property_detail'])->name('property_detail');
Route::get('/locations', [FrontController::class, 'locations'])->name('locations');

Route::get('/location/{slug}', [FrontController::class, 'location'])->name('location');

// User
Route::middleware('auth')->group(function () {
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

Route::middleware('agent')->prefix('agent')->group(function () {
    Route::get('/dashboard-agent', [AgentController::class, 'dashboard'])->name('agent_dashboard');
    Route::get('/profile', [AgentController::class, 'profile'])->name('agent_profile');
    Route::post('/profile', [AgentController::class, 'profile_submit'])->name('agent_profile_submit');
    Route::get('/order', [AgentController::class, 'order'])->name('agent_order');
    Route::get('/invoice/{id}', [AgentController::class, 'invoice'])->name('agent_invoice');
    Route::get('/agent-payment', [AgentController::class, 'payment'])->name('agent_payment');

    Route::post('/paypal', [AgentController::class, 'paypal'])->name('agent_paypal');
    Route::get('/paypal-success', [AgentController::class, 'paypal_success'])->name('agent_paypal_success');
    Route::get('/paypal-canceled', [AgentController::class, 'paypal_canceled'])->name('agent_paypal_canceled');

    Route::post('/stripe', [AgentController::class, 'stripe'])->name('agent_stripe');
    Route::get('/stripe-success', [AgentController::class, 'stripe_success'])->name('agent_stripe_success');
    Route::get('/stripe-canceled', [AgentController::class, 'stripe_canceled'])->name('agent_stripe_canceled');

    Route::get('/properties/index', [AgentController::class, 'property'])->name('agent_property_index');
    Route::get('/property/create', [AgentController::class, 'property_create'])->name('agent_property_create');
    Route::post('/property/store', [AgentController::class, 'property_store'])->name('agent_property_store');
    Route::get('/property/edit/{id}', [AgentController::class, 'property_edit'])->name('agent_property_edit');
    Route::put('/property/update', [AgentController::class, 'property_update'])->name('agent_property_update');
    Route::delete('/property/delete/{id}', [AgentController::class, 'destroy'])->name('agent_property_deleted');


    Route::get('/property/photo-gallery/{id}', [AgentController::class, 'photo_gallery'])->name('agent_property_photo_gallery');
    Route::post('/property/photo-gallery/store/{id}', [AgentController::class, 'photo_gallery_store'])->name('agent_property_photo_gallery_store');
    Route::delete('/property/photo-gallery/store/{id}', [AgentController::class, 'photo_gallery_delete'])->name('agent_property_photo_gallery_delete');
    Route::get('/property/video-gallery/{id}', [AgentController::class, 'video_gallery'])->name('agent_property_video_gallery');
    Route::post('/property/video-gallery/store/{id}', [AgentController::class, 'video_gallery_store'])->name('agent_property_video_gallery_store');
    Route::delete('/property/video-gallery/delete/{id}', [AgentController::class, 'video_gallery_delete'])->name('agent_property_video_gallery_delete');
});
Route::prefix('agent')->group(function () {
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
Route::middleware('admin')->prefix('admin')->group(function () {
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


    Route::get('/customers/index', [AdminCustomerController::class, 'index'])->name('admin_customers_index');
    Route::get('/customer/create', [AdminCustomerController::class, 'create'])->name('admin_customer_create');
    Route::post('/customer/store', [AdminCustomerController::class, 'store'])->name('admin_customer_store');
    Route::get('/customer/edit/{id}', [AdminCustomerController::class, 'edit'])->name('admin_customer_edit');
    Route::put('/customer/update', [AdminCustomerController::class, 'update'])->name('admin_customer_update');
    Route::delete('/customer/delete/{id}', [AdminCustomerController::class, 'destroy'])->name('admin_customer_deleted');

    Route::get('/agents/index', [AdminAgentController::class, 'index'])->name('admin_agents_index');
    Route::get('/agent/create', [AdminAgentController::class, 'create'])->name('admin_agent_create');
    Route::post('/agent/store', [AdminAgentController::class, 'store'])->name('admin_agent_store');
    Route::get('/agent/edit/{id}', [AdminAgentController::class, 'edit'])->name('admin_agent_edit');
    Route::put('/agent/update', [AdminAgentController::class, 'update'])->name('admin_agent_update');
    Route::delete('/agent/delete/{id}', [AdminAgentController::class, 'destroy'])->name('admin_agent_deleted');

    Route::get('/types/index', [AdminTypeController::class, 'index'])->name('admin_types_index');
    Route::get('/type/create', [AdminTypeController::class, 'create'])->name('admin_type_create');
    Route::post('/type/store', [AdminTypeController::class, 'store'])->name('admin_type_store');
    Route::get('/type/edit/{id}', [AdminTypeController::class, 'edit'])->name('admin_type_edit');
    Route::put('/type/update', [AdminTypeController::class, 'update'])->name('admin_type_update');
    Route::delete('/type/delete/{id}', [AdminTypeController::class, 'destroy'])->name('admin_type_deleted');


    Route::get('/amenity/index', [AdminAmenityController::class, 'index'])->name('admin_amenity_index');
    Route::get('/amenity/create', [AdminAmenityController::class, 'create'])->name('admin_amenity_create');
    Route::post('/amenity/store', [AdminAmenityController::class, 'store'])->name('admin_amenity_store');
    Route::get('/amenity/edit/{id}', [AdminAmenityController::class, 'edit'])->name('admin_amenity_edit');
    Route::put('/amenity/update', [AdminAmenityController::class, 'update'])->name('admin_amenity_update');
    Route::delete('/amenity/delete/{id}', [AdminAmenityController::class, 'destroy'])->name('admin_amenity_deleted');




    Route::get('/property/index', [AdminPropertyController::class, 'index'])->name('admin_property_index');
    Route::get('/property/edit/{id}', [AdminPropertyController::class, 'edit'])->name('admin_property_edit');
    Route::put('/property/update', [AdminPropertyController::class, 'update'])->name('admin_property_update');
    Route::get('/property/detail/{id}', [AdminPropertyController::class, 'details'])->name('admin_property_details');



    Route::get('/order/index', [AdminOrderController::class, 'index'])->name('admin_order_index');
    Route::get('/invoice/{id}', [AdminOrderController::class, 'invoice'])->name('admin_invoice');
});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin_login');
    });
    Route::get('/login', [AdminController::class, 'login'])->name('admin_login');
    Route::post('/login', [AdminController::class, 'login_submit'])->name('admin_login_submit');
    Route::get('/forget-password', [AdminController::class, 'forget_password'])->name('admin_forget_password');
    Route::post('/forget-password', [AdminController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
    Route::get('/reset-password/{token}/{email}', [AdminController::class, 'reset_password'])->name('admin_reset_password');
    Route::post('/reset-password/{token}/{email}', [AdminController::class, 'reset_password_submit'])->name('admin_reset_password_submit');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin_logout');
});
