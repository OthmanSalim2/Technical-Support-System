<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;


Route::get('/technical-support-system/login', [AuthenticationController::class, 'loginPage'])->name('loginPage');
Route::post('/technical-support-system/login', [AuthenticationController::class, 'login'])->name('login');
Route::get('/technical-support-system/logout', [AuthenticationController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/technical-support-system', function () {
        return view('pages/home');
    })->name('home');

    Route::get('/technical-support-system/contact', function () {
        return view('pages/contact');
    })->name('contact');

    Route::get('technical-support-system/orders/orders-completed', [OrderController::class, 'getOrdersCompleted'])->name('orders.completed');
    Route::get('technical-support-system/orders/orders-processing', [OrderController::class, 'getOrdersProcessed'])->name('orders.processed');
    Route::delete('technical-support-system/orders/orders-processing/{id?}', [OrderController::class, 'deleteOrdersProcessed'])->name('orders.delete-processing-order');
    Route::delete('technical-support-system/orders/orders-completed/{id?}', [OrderController::class, 'deleteOrdersCompleted'])->name('orders.delete-completed-order');
    Route::resource('technical-support-system/orders', OrderController::class);
    Route::get('technical-support-system/orders/convert-processing-order-to-completed/{id?}', [OrderController::class, 'convertOrder'])->name('orders.convertOrder');

    Route::get('technical-support-system/permissions', [PermissionsController::class, 'index'])->name('permissions.index');
    Route::get('technical-support-system/permissions/create', [PermissionsController::class, 'create'])->name('permissions.create');
    Route::get('technical-support-system/permissions/user-permissions', [PermissionsController::class, 'userPermissions'])->name('permissions.user_permissions');
    Route::post('technical-support-system/permissions/create', [PermissionsController::class, 'store'])->name('permissions.store');
    Route::get('technical-support-system/permissions/edit/{user?}', [PermissionsController::class, 'edit'])->name('permissions.edit');
    Route::patch('technical-support-system/permissions/edit/{permission?}', [PermissionsController::class, 'update'])->name('permissions.update');
    Route::delete('technical-support-system/permissions/delete/{permission?}', [PermissionsController::class, 'destroy'])->name('permissions.delete');
    Route::post('technical-support-system/permissions/user', [PermissionsController::class, 'storePermission'])->name('storePermission');
    Route::get('technical-support-system/permissions/edit-permission/{permission?}', [PermissionsController::class, 'editPermission'])->name('edit-permission');
    Route::patch('technical-support-system/permissions/edit-permission/{permission?}', [PermissionsController::class, 'updatePermission'])->name('updatePermission');

    Route::resource('technical-support-system/departments', DepartmentController::class);

    Route::get('technical-support-system/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('technical-support-system/users/create', [UsersController::class, 'create'])->name('users.create');
    Route::post('technical-support-system/users/create', [UsersController::class, 'store'])->name('users.store');
    Route::get('technical-support-system/users/edit/{user?}', [UsersController::class, 'edit'])->name('users.edit');
    Route::patch('technical-support-system/users/edit/{user?}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('technical-support-system/users/delete/{user?}', [UsersController::class, 'destroy'])->name('users.delete');

});

