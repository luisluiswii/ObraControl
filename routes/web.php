<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\FichajeController;

/*
|--------------------------------------------------------------------------
| Página de inicio personalizada
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('intro');
});

Auth::routes();

/*
|--------------------------------------------------------------------------
| Dashboard principal
|--------------------------------------------------------------------------
*/
Route::get('/home', [HomeController::class, 'index'])->name('home');

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
