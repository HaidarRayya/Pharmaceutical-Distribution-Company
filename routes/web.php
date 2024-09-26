<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\AdminDriverController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Admin\MedicineController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\driverManager\DriverManagerController;
use App\Http\Controllers\Driver\DriverController;
use App\Http\Controllers\Customer\OrderController;
use Illuminate\Support\Facades\Route;

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

Route::get('/signin', [AuthController::class, 'showsignin'])->name('login');;
Route::post('/signin', [AuthController::class, 'signin']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/signup', [AuthController::class, 'signup']);
Route::get('/signupPage', [AuthController::class, 'showsignup']);
Route::get('/inputEmailPage', [ForgetPasswordController::class, 'inputEmailPage']);
Route::get('/inputVerficationCodePage', [ForgetPasswordController::class, 'inputVerficationCodePage']);
Route::get('/inputPasswordPage', [ForgetPasswordController::class, 'inputPasswordPage']);
Route::post('/inputEmail', [ForgetPasswordController::class, 'inputEmail']);
Route::post('/inputVerficationCode', [ForgetPasswordController::class, 'inputVerficationCode']);
Route::post('/changePassword', [ForgetPasswordController::class, 'changePassword']);


// customer
Route::get('/', [CustomerController::class, 'index']);
Route::get('/customer', [CustomerController::class, 'index']);

Route::get('/customer/editProifile', [CustomerController::class, 'updateProfilePage'])->middleware('auth');
Route::post('/customer/editProifile', [CustomerController::class, 'updateProfile'])->middleware('auth');
Route::get('/customer/companies/{company}', [CustomerController::class, 'show']);
Route::resource('customer.cart', CartController::class)->middleware('auth');
Route::post('/confirmOrder', [CartController::class, 'confirmOrder'])->middleware('auth');
Route::resource('customer.orders', OrderController::class)->except(['update', 'store', 'create', 'edit'])->middleware('auth');

//admin

Route::resource('admin', AdminController::class)->only('index');
Route::resource('admin.drivers', AdminDriverController::class);
Route::resource('companies', CompanyController::class);
Route::delete('/companies/confirmDestroy/{company}', [CompanyController::class, 'confirmDestroy']);
Route::resource('companies.medicines', MedicineController::class)->except('show');
Route::get('/acceptreject', [AdminController::class, 'showAcceptRejectPage']);
Route::post('/accept/{user}', [AdminController::class, 'accept']);
Route::post('/reject/{user}', [AdminController::class, 'reject']);
Route::resource('admin.orders', AdminOrderController::class)->only(['index', 'show']);
Route::get('/admin/{admin}/acceptedOrders', [AdminOrderController::class, 'acceptedOrders'])->name('admin.orders.acceptedOrders');
Route::get('/admin/{admin}/orders/{order}/chooseDriver', [AdminOrderController::class, 'chooseDriverPage']);

Route::post('/admin/reject/{order}', [AdminOrderController::class, 'reject']);
Route::post('/admin/accept/{order}/{driver}', [AdminOrderController::class, 'accept']);


Route::get('/driverManager', [DriverManagerController::class, 'index']);
Route::get('/driverManager/{order}', [DriverManagerController::class, 'show']);
Route::post('/driverManager/{order}/accept', [DriverManagerController::class, 'accept']);



Route::get('/driver', [DriverController::class, 'index']);
Route::get('/driver/editProifile', [DriverController::class, 'updateProfilePage']);
Route::post('/driver/editProifile', [DriverController::class, 'updateProfile']);
Route::post('/driver/{order}/start', [DriverController::class, 'start']);
Route::post('/driver/{order}/done', [DriverController::class, 'done']);