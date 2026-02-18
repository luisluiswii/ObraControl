<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\DocumentosController;
use App\Http\Controllers\FichajeController;
use App\Http\Controllers\MiPanelController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\UsuariosController;
use App\Models\Fichaje;
use App\Models\Obra;
use App\Models\Trabajador;

/*
|--------------------------------------------------------------------------
| LANDING PÚBLICA
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('public');
})->name('public');

/*
|--------------------------------------------------------------------------
| AUTH (SIN REGISTRO PÚBLICO)
|--------------------------------------------------------------------------
*/

Auth::routes(['register' => false]);

/*
|--------------------------------------------------------------------------
| APP PRIVADA (TODO PROTEGIDO POR LOGIN)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', \App\Http\Middleware\EnsurePasswordChanged::class])->group(function () {
    // Dashboard (admin ve el dashboard interno; usuario ve Mi Panel)
    Route::get('/dashboard', [MiPanelController::class, 'dashboard'])->name('dashboard');

    // Panel de gestión solo para admin/superadmin
    Route::get('/gestion', function () {
        $user = auth()->user();
        if (!$user || !$user->isAdmin()) {
            return redirect()->route('dashboard')->with('error', 'No tienes acceso a la gestión.');
        }

        $obrasCount = Obra::count();
        $trabajadoresCount = Trabajador::count();
        $fichajesHoy = Fichaje::whereDate('fecha', now()->toDateString())->count();
        $jornadasAbiertas = Fichaje::whereNull('hora_salida')->count();

        return view('gestion', compact('obrasCount', 'trabajadoresCount', 'fichajesHoy', 'jornadasAbiertas'));
    })->name('gestion');

    Route::get('/gestion-general', function () {
        $user = auth()->user();
        if (!$user || !$user->isAdmin()) {
            return redirect()->route('dashboard')->with('error', 'No tienes acceso a la gestión general.');
        }

        return redirect()->route('gestion');
    })->name('gestion.general');

    // Perfil + documentos
    Route::get('/perfil', [PerfilController::class, 'show'])->name('perfil');
    Route::post('/perfil/foto', [PerfilController::class, 'updatePhoto'])->name('perfil.foto');
    Route::get('/perfil/password', [PerfilController::class, 'password'])->name('perfil.password');
    Route::put('/perfil/password', [PerfilController::class, 'updatePassword'])->name('perfil.password.update');

    Route::resource('documentos', DocumentosController::class)
        ->only(['index', 'create', 'store', 'destroy']);

    // Superadmin: gestión de usuarios del CRM
    Route::middleware('can:manageUsers')->group(function () {
        Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
            Route::post('/usuarios/sync', [UsuariosController::class, 'syncTrabajadores'])->name('usuarios.sync');
        Route::put('/usuarios/{user}/rol', [UsuariosController::class, 'updateRole'])->name('usuarios.role');
        Route::delete('/usuarios/{user}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');
        Route::post('/usuarios/trabajador/{trabajador}', [UsuariosController::class, 'createFromTrabajador'])->name('usuarios.fromTrabajador');
    });

    // Usuario normal: mi jornada
    Route::post('/mi-jornada/iniciar', [MiPanelController::class, 'iniciarMiJornada'])->name('mi-jornada.iniciar');
    Route::post('/mi-jornada/finalizar', [MiPanelController::class, 'finalizarMiJornada'])->name('mi-jornada.finalizar');

    // ADMIN: gestión de recursos
    Route::middleware('can:viewGestion')->group(function () {
        // Trabajadores (papelera + CRUD)
        Route::get('/trabajadores/papelera', [TrabajadorController::class, 'papelera'])
            ->name('trabajadores.papelera');
        Route::post('/trabajadores/{trabajador}/restaurar', [TrabajadorController::class, 'restaurar'])
            ->name('trabajadores.restaurar');
        Route::delete('/trabajadores/{trabajador}/eliminar-definitivo', [TrabajadorController::class, 'eliminarDefinitivo'])
            ->name('trabajadores.eliminarDefinitivo');
        Route::resource('trabajadores', TrabajadorController::class)
            ->parameters(['trabajadores' => 'trabajador']);

        // Obras (papelera + CRUD)
        Route::get('/obras/papelera', [ObraController::class, 'papelera'])
            ->name('obras.papelera');
        Route::post('/obras/{obra}/restaurar', [ObraController::class, 'restaurar'])
            ->name('obras.restaurar');
        Route::delete('/obras/{obra}/eliminar-definitivo', [ObraController::class, 'eliminarDefinitivo'])
            ->name('obras.eliminarDefinitivo');
        Route::resource('obras', ObraController::class);

        // Quitar trabajador de una obra
        Route::delete('/obras/{obra}/quitar/{trabajador}', [ObraController::class, 'quitarTrabajador'])
            ->name('obras.quitarTrabajador');

        // Asignaciones
        Route::get('/asignaciones', [AsignacionController::class, 'index'])->name('asignaciones.index');
        Route::get('/asignaciones/create', [AsignacionController::class, 'create'])->name('asignaciones.create');
        Route::post('/asignaciones', [AsignacionController::class, 'store'])->name('asignaciones.store');
        Route::delete('/asignaciones/{id}', [AsignacionController::class, 'destroy'])->name('asignaciones.destroy');

        // Fichajes/Jornadas globales (admin)
        Route::get('/fichajes', [FichajeController::class, 'index'])->name('fichajes.index');
        Route::get('/fichajes/create', [FichajeController::class, 'create'])->name('fichajes.create');
        Route::post('/fichajes', [FichajeController::class, 'store'])->name('fichajes.store');
        Route::delete('/fichajes/{id}', [FichajeController::class, 'destroy'])->name('fichajes.destroy');
        Route::get('/jornadas', [FichajeController::class, 'jornadas'])->name('jornadas.index');
        Route::post('/jornadas/iniciar', [FichajeController::class, 'iniciarJornada'])->name('jornadas.iniciar');
        Route::post('/jornadas/{id}/finalizar', [FichajeController::class, 'finalizarJornada'])->name('jornadas.finalizar');
    });

    // Compatibilidad: /home
    Route::get('/home', function () {
        return redirect()->route('dashboard');
    })->name('home');
});

