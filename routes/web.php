use App\Http\Controllers\ProductosController;
Route::resource('productos', ProductosController::class);
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\FichajeController;
use App\Models\Fichaje;
use App\Models\Obra;
use App\Models\Trabajador;

/*
|--------------------------------------------------------------------------
| Página de inicio personalizada (Bienvenida ClearTime)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $obrasCount = Obra::count();
    $trabajadoresCount = Trabajador::count();
    $fichajesHoy = Fichaje::whereDate('fecha', now()->toDateString())->count();
    $jornadasAbiertas = Fichaje::whereNull('hora_salida')->count();

    $trabajadores = Trabajador::orderBy('nombre')->get();
    $obras = Obra::orderBy('nombre')->get();

    return response()
        ->view('bienvenido', compact(
        'obrasCount',
        'trabajadoresCount',
        'fichajesHoy',
        'jornadasAbiertas',
        'trabajadores',
        'obras'
    ))
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');
})->name('bienvenido');

Route::get('/preview', function () {
    $obrasCount = Obra::count();
    $trabajadoresCount = Trabajador::count();
    $fichajesHoy = Fichaje::whereDate('fecha', now()->toDateString())->count();
    $jornadasAbiertas = Fichaje::whereNull('hora_salida')->count();

    $trabajadores = Trabajador::orderBy('nombre')->get();
    $obras = Obra::orderBy('nombre')->get();

    return response()
        ->view('bienvenido', compact(
        'obrasCount',
        'trabajadoresCount',
        'fichajesHoy',
        'jornadasAbiertas',
        'trabajadores',
        'obras'
    ))
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');
})->name('bienvenido.preview');

/*
|--------------------------------------------------------------------------
| Redirección del Dashboard y del logo ClearTime
|--------------------------------------------------------------------------
*/
Route::get('/home', function () {
    return redirect()->route('bienvenido');
})->name('home');

Auth::routes();

/*
|--------------------------------------------------------------------------
| PAPELERA TRABAJADORES
|--------------------------------------------------------------------------
*/
Route::get('/trabajadores/papelera', [TrabajadorController::class, 'papelera'])
    ->name('trabajadores.papelera');

Route::post('/trabajadores/{trabajador}/restaurar', [TrabajadorController::class, 'restaurar'])
    ->name('trabajadores.restaurar');

Route::delete('/trabajadores/{trabajador}/eliminar-definitivo', [TrabajadorController::class, 'eliminarDefinitivo'])
    ->name('trabajadores.eliminarDefinitivo');

/*
|--------------------------------------------------------------------------
| CRUD TRABAJADORES
|--------------------------------------------------------------------------
*/
Route::resource('trabajadores', TrabajadorController::class)
    ->parameters(['trabajadores' => 'trabajador']);

/*
|--------------------------------------------------------------------------
| PAPELERA OBRAS
|--------------------------------------------------------------------------
*/
Route::get('/obras/papelera', [ObraController::class, 'papelera'])
    ->name('obras.papelera');

Route::post('/obras/{obra}/restaurar', [ObraController::class, 'restaurar'])
    ->name('obras.restaurar');

Route::delete('/obras/{obra}/eliminar-definitivo', [ObraController::class, 'eliminarDefinitivo'])
    ->name('obras.eliminarDefinitivo');

/*
|--------------------------------------------------------------------------
| CRUD OBRAS
|--------------------------------------------------------------------------
*/
Route::resource('obras', ObraController::class);

/*
|--------------------------------------------------------------------------
| QUITAR TRABAJADOR DE UNA OBRA
|--------------------------------------------------------------------------
*/
Route::delete('/obras/{obra}/quitar/{trabajador}', [ObraController::class, 'quitarTrabajador'])
    ->name('obras.quitarTrabajador');

/*
|--------------------------------------------------------------------------
| ASIGNACIONES
|--------------------------------------------------------------------------
*/
Route::get('/asignaciones', [AsignacionController::class, 'index'])->name('asignaciones.index');
Route::get('/asignaciones/create', [AsignacionController::class, 'create'])->name('asignaciones.create');
Route::post('/asignaciones', [AsignacionController::class, 'store'])->name('asignaciones.store');
Route::delete('/asignaciones/{id}', [AsignacionController::class, 'destroy'])->name('asignaciones.destroy');

/*
|--------------------------------------------------------------------------
| FICHAJES
|--------------------------------------------------------------------------
*/
Route::get('/fichajes', [FichajeController::class, 'index'])->name('fichajes.index');
Route::get('/fichajes/create', [FichajeController::class, 'create'])->name('fichajes.create');
Route::post('/fichajes', [FichajeController::class, 'store'])->name('fichajes.store');
Route::delete('/fichajes/{id}', [FichajeController::class, 'destroy'])->name('fichajes.destroy');

/*
|--------------------------------------------------------------------------
| JORNADAS (Panel / Iniciar / Finalizar)
|--------------------------------------------------------------------------
*/
Route::get('/jornadas', [FichajeController::class, 'jornadas'])
    ->name('jornadas.index');

Route::post('/jornadas/iniciar', [FichajeController::class, 'iniciarJornada'])
    ->name('jornadas.iniciar');

Route::post('/jornadas/{id}/finalizar', [FichajeController::class, 'finalizarJornada'])
    ->name('jornadas.finalizar');
