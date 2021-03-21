<?php

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



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

//USERS
Route::get('user/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create.vista');
Route::post('user/create', [App\Http\Controllers\UserController::class, 'createUser'])->name('user.create');
Route::get('user/update/{user_id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update.vista');
Route::post('user/update/{user_id}', [App\Http\Controllers\UserController::class, 'updateUser'])->name('user.update');
Route::get('user/list', [App\Http\Controllers\UserController::class, 'getUser'])->name('user.lista');

//Proveedores
Route::get('provedor/create', [App\Http\Controllers\ProveedoresController::class, 'create'])->name('proveedor.create.vista');
Route::post('proveedor/create', [App\Http\Controllers\ProveedoresController::class, 'createProveedor'])->name('proveedor.create');
Route::get('proveedor/update/{user_id}', [App\Http\Controllers\ProveedoresController::class, 'update'])->name('proveedor.update.vista');
Route::post('proveedor/update/{user_id}', [App\Http\Controllers\ProveedoresController::class, 'updateProveedor'])->name('proveedor.update');
Route::get('proveedor/list', [App\Http\Controllers\ProveedoresController::class, 'getProveedor'])->name('proveedor.lista');




