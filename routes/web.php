<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VehicleBrandController;
use App\Http\Controllers\VehicleModelController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminDashboardController;

use App\Http\Controllers\WebController;


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

// Route::get('/', function () {
//     return view('auth/login');
// });


Auth::routes();

Route::get('/', [WebController::class, 'index']);
Route::get('/vehical_details/{id}', [WebController::class, 'web_vehicle_detail']);

Route::get('admin/', [LoginController::class, 'index'])->name('showLoginForm');


Route::group(['middleware' => ['role:super-admin|admin']], function() {

    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions_create');
    Route::post('/create_permissions', [PermissionController::class, 'store']);
    Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions_edit');
    Route::put('/update_permissions/{permission}', [PermissionController::class, 'update']);
    Route::get('permissions/{permissionId}/delete', [PermissionController::class, 'destroy']);

    Route::get('/roles', [RoleController::class, 'index'])->name('roles');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles_create');
    Route::post('/create_roles', [RoleController::class, 'store']);
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles_edit');
    Route::put('/update_roles/{role}', [RoleController::class, 'update']);
    Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy'])->name('delete');
    Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole'])->name('givepermission');
    Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole'])->name('givepermission');

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/create', [UserController::class, 'create'])->name('user_create');
    Route::post('/create_user', [UserController::class, 'store']);
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('user_edit');
    Route::put('/update_user/{user}', [UserController::class, 'update']);
    Route::get('/users/{userId}/delete', [UserController::class, 'destroy']);

});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['role:super-admin|admin']], function() {

    // Vehicle Brand Routes
    Route::get('/brand', [VehicleBrandController::class, 'index'])->name('brand');
    Route::post('/brandInsert', [VehicleBrandController::class, 'store'])->name('brandInsert');
    Route::get('/brandEdit/{id}', [VehicleBrandController::class, 'edit'])->name('brandEdit');
    Route::post('/brandUpdate', [VehicleBrandController::class, 'update'])->name('brandUpdate');
    Route::post('/brandDelete', [VehicleBrandController::class, 'delete'])->name('brandDelete');

    // Vehicle mod Routes
    Route::get('/model', [VehicleModelController::class, 'index'])->name('model');
    Route::post('/model_insert', [VehicleModelController::class, 'store'])->name('model_insert');
    Route::get('/model_edit/{id}', [VehicleModelController::class, 'edit'])->name('model_edit');
    Route::post('/model_update', [VehicleModelController::class, 'update'])->name('model_update');
    Route::post('/model_delete', [VehicleModelController::class, 'delete'])->name('model_delete');
    Route::get('/get_model_by_brand/{id}', [VehicleModelController::class, 'get_model_by_brand'])->name('get_model_by_brand');

    // Vehicle Name Routes
    Route::get('/vehicle', [VehicleController::class, 'index'])->name('vehicle');
    Route::post('/vehicleInsert', [VehicleController::class, 'store'])->name('vehicleInsert');
    Route::get('/vehicleEdit/{id}', [VehicleController::class, 'edit'])->name('vehicleEdit');
    Route::post('/vehicleUpdate', [VehicleController::class, 'update'])->name('vehicleUpdate');
    Route::post('/vehicleDelete', [VehicleController::class, 'delete'])->name('vehicleDelete');
    Route::get('/vehicle_model_list_sel2', [VehicleController::class, 'vehicle_model_list_sel2'])->name('vehicle_model_list_sel2');

    // Vehicle Booking Routes
    Route::get('/booking', [BookingController::class, 'index'])->name('booking');
    Route::post('/bookingInsert', [BookingController::class, 'store'])->name('bookingInsert');
    Route::get('/bookingEdit/{id}', [BookingController::class, 'edit'])->name('bookingEdit');
    Route::post('/bookingUpdate', [BookingController::class, 'update'])->name('bookingUpdate');
    Route::post('/bookingDelete', [BookingController::class, 'delete'])->name('bookingDelete');
});











