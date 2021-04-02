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

//Productos
Route::get('productos/create', [App\Http\Controllers\ProductosController::class, 'create'])->name('productos.create.vista');
Route::post('productos/create', [App\Http\Controllers\ProductosController::class, 'createProductos'])->name('productos.create');
Route::get('productos/update/{user_id}', [App\Http\Controllers\ProductosController::class, 'update'])->name('productos.update.vista');
Route::post('productos/update/{user_id}', [App\Http\Controllers\ProductosController::class, 'updateProductos'])->name('productos.update');
Route::get('productos/list', [App\Http\Controllers\ProductosController::class, 'getProductos'])->name('productos.lista');
Route::get('productos/stock', [App\Http\Controllers\ProductosController::class, 'getProductosStock'])->name('productos.lista');
Route::get('productos/sin-stock', [App\Http\Controllers\ProductosController::class, 'sinStock'])->name('productos.lista');

//Lotes
Route::get('lotes/create/{producto_id}', [App\Http\Controllers\LotesController::class, 'create'])->name('lotes.create.vista');
Route::post('lotes/create/{producto_id}', [App\Http\Controllers\LotesController::class, 'createLotes'])->name('lotes.create');
Route::get('lotes/update/{lote_id}', [App\Http\Controllers\LotesController::class, 'update'])->name('lotes.update.vista');
Route::post('lotes/update/{lote_id}', [App\Http\Controllers\LotesController::class, 'updateLotes'])->name('lotes.update');
Route::get('lotes/list/{producto_id}', [App\Http\Controllers\LotesController::class, 'getLotes'])->name('lotes.lista');

//Clientes
Route::get('clientes/create', [App\Http\Controllers\ClientesController::class, 'create'])->name('clientes.create.vista');
Route::post('clientes/create', [App\Http\Controllers\ClientesController::class, 'createClientes'])->name('clientes.create');
Route::get('clientes/update/{cliente_id}', [App\Http\Controllers\ClientesController::class, 'update'])->name('clientes.update.vista');
Route::post('clientes/update/{cliente_id}', [App\Http\Controllers\ClientesController::class, 'updateClientes'])->name('clientes.update');
Route::get('clientes/list', [App\Http\Controllers\ClientesController::class, 'getClientes'])->name('clientes.lista');
Route::post('ventas/cliente', [App\Http\Controllers\ClientesController::class, 'getOneClient'])->name('clientes.one');

//Ventas
Route::get('ventas/todas/{filtro?}/{fecha_inicio?}/{fecha_final?}/{id?}', [App\Http\Controllers\VentasController::class, 'getVentas'])->name('ventas.lista');
Route::get('ventas/create', [App\Http\Controllers\VentasController::class, 'create'])->name('ventas.create.vista');
Route::post('ventas/create', [App\Http\Controllers\VentasController::class, 'createVenta'])->name('ventas.create');
Route::get('ventas/fecha', [App\Http\Controllers\VentasController::class, 'fechaVista'])->name('ventas.fecha');
Route::get('ventas/descargar/{filtro?}/{fecha_inicio?}/{fecha_final?}/{id?}', [App\Http\Controllers\VentasController::class, 'export'])->name('ventas.descargar');

