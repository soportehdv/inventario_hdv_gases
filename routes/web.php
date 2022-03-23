<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

//Lotes
Route::get('lotes/create/{producto_id}', [App\Http\Controllers\LotesController::class, 'create'])->name('lotes.create.vista');
Route::post('lotes/create/{producto_id}', [App\Http\Controllers\LotesController::class, 'createLotes'])->name('lotes.create');
Route::get('lotes/update/{lote_id}', [App\Http\Controllers\LotesController::class, 'update'])->name('lotes.update.vista');
Route::post('lotes/update/{lote_id}', [App\Http\Controllers\LotesController::class, 'updateLotes'])->name('lotes.update');
Route::get('lotes/list/{producto_id}', [App\Http\Controllers\LotesController::class, 'getLotes'])->name('lotes.lista');
Route::get('lotes/todos', [App\Http\Controllers\LotesController::class, 'getAll'])->name('lotes.todos');

//Clientes
Route::get('clientes/create', [App\Http\Controllers\ClientesController::class, 'create'])->name('clientes.create.vista');
Route::post('clientes/create', [App\Http\Controllers\ClientesController::class, 'createClientes'])->name('clientes.create');
Route::get('clientes/update/{cliente_id}', [App\Http\Controllers\ClientesController::class, 'update'])->name('clientes.update.vista');
Route::post('clientes/update/{cliente_id}', [App\Http\Controllers\ClientesController::class, 'updateClientes'])->name('clientes.update');
Route::get('clientes/list/{filtro?}', [App\Http\Controllers\ClientesController::class, 'getClientes'])->name('clientes.lista');

//Ventas
Route::get('ventas/todas/{filtro?}/{fecha_inicio?}/{fecha_final?}/{id?}', [App\Http\Controllers\VentasController::class, 'getVentas'])->name('ventas.lista');
Route::get('ventas/create', [App\Http\Controllers\VentasController::class, 'create'])->name('ventas.create.vista');
Route::post('ventas/create', [App\Http\Controllers\VentasController::class, 'createVenta'])->name('ventas.create');
Route::get('ventas/fecha', [App\Http\Controllers\VentasController::class, 'fechaVista'])->name('ventas.fecha');
Route::get('ventas/descargar/{filtro?}/{fecha_inicio?}/{fecha_final?}/{id?}', [App\Http\Controllers\VentasController::class, 'export'])->name('ventas.descargar');

//Precios
Route::get('precios/create', [App\Http\Controllers\Precios_productosController::class, 'create'])->name('precios.create.vista');
Route::post('precios/create', [App\Http\Controllers\Precios_productosController::class, 'createPrecios'])->name('precios.create');
Route::get('precios/mostrar', [App\Http\Controllers\Precios_productosController::class, 'getPrecios'])->name('precios.lista');
Route::post('precios/update/{precio_id}', [App\Http\Controllers\Precios_productosController::class, 'updatePrecios'])->name('precios.update');
Route::get('precios/update/{precio_id}', [App\Http\Controllers\Precios_productosController::class, 'update'])->name('precios.update.vista');

//Detalle de ventas
Route::get('ventas/detalle/{venta_id}', [App\Http\Controllers\Detalle_ventasController::class, 'getDetalle'])->name('ventas.detalle');
Route::get('detalles/descargar/{venta_id}', [App\Http\Controllers\Detalle_ventasController::class, 'imprimirFactura'])->name('detalles.descargar.factura');

//Compras
Route::get('compras/create', [App\Http\Controllers\ComprasController::class, 'create'])->name('compras.create.vista');
Route::post('compras/create', [App\Http\Controllers\ComprasController::class, 'createCompras'])->name('compras.create');
Route::get('compras/update/{compra_id}', [App\Http\Controllers\ComprasController::class, 'update'])->name('compras.update.vista');
Route::post('compras/update/{compra_id}', [App\Http\Controllers\ComprasController::class, 'updatecompras'])->name('compras.update');
Route::get('compras/lista', [App\Http\Controllers\ComprasController::class, 'getCompras'])->name('compras.lista');


//Lista de precios
Route::get('nombres/create', [App\Http\Controllers\listapreciosController::class, 'create'])->name('listaprecios.create.vista');
Route::post('nombres/create', [App\Http\Controllers\listapreciosController::class, 'createlistaprecios'])->name('listaprecios.create');
Route::get('nombres/lista', [App\Http\Controllers\listapreciosController::class, 'getlistaprecios'])->name('listaprecios.lista');
Route::get('nombres/update/{precio_id}', [App\Http\Controllers\listapreciosController::class, 'update'])->name('listaprecios.update.vista');
Route::post('nombres/update/{precio_id}', [App\Http\Controllers\listapreciosController::class, 'updatelistaprecios'])->name('listaprecios.update');

//Fracciones
Route::get('fracciones/create', [App\Http\Controllers\FraccionesController::class, 'create'])->name('fracciones.create.vista');
Route::post('fracciones/create', [App\Http\Controllers\FraccionesController::class, 'createfraccion'])->name('fracciones.create');
Route::get('fracciones/lista', [App\Http\Controllers\FraccionesController::class, 'getfraccion'])->name('fracciones.lista');
Route::get('fracciones/update/{precio_id}', [App\Http\Controllers\FraccionesController::class, 'update'])->name('fracciones.update.vista');
Route::post('fracciones/update/{precio_id}', [App\Http\Controllers\FraccionesController::class, 'updatefraccion'])->name('fracciones.update');

//Stock
Route::get('stock/list', [App\Http\Controllers\StockController::class, 'getStock'])->name('stock.list');
// Route::get('stock/list', [App\Http\Controllers\UserController::class, 'create'])->name('user.create.vista');
