<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:manageUsers');
    }

    public function index(Request $request)
    {
        $perPage = (int) $request->input('per_page', 12);
        $perPage = max(5, min(50, $perPage));

        $usuarios = User::query()
            ->with('trabajador')
            ->orderBy('id')
            ->paginate($perPage);

        $trabajadoresSinUsuario = Trabajador::query()
            ->whereNotNull('email')
            ->where('email', '!=', '')
            ->whereNotIn('email', function ($q) {
                $q->select('email')->from('users');
            })
            ->orderBy('id')
            ->get();

        return view('usuarios.index', compact('usuarios', 'trabajadoresSinUsuario', 'perPage'));
    }

    public function syncTrabajadores(Request $request)
    {
        $created = 0;
        $updated = 0;
        $skipped = 0;

        $trabajadores = Trabajador::query()
            ->whereNotNull('email')
            ->where('email', '<>', '')
            ->orderBy('id')
            ->get();

        foreach ($trabajadores as $t) {
            $email = trim((string) $t->email);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $skipped++;
                continue;
            }

            $name = trim($t->nombre . ' ' . $t->apellido);
            if ($name === '') {
                $name = $email;
            }

            $user = User::query()->where('email', $email)->first();
            if ($user) {
                // Normaliza roles vacíos antiguos
                if (!$user->role) {
                    $user->role = 'usuario';
                    $user->save();
                    $updated++;
                }
                continue;
            }

            User::create([
                'name' => $name,
                'email' => $email,
                // Contraseña inicial genérica (cámbiala después). Sin correo SMTP, es lo más práctico.
                'password' => Hash::make('password'),
                'role' => 'usuario',
                'remember_token' => Str::random(10),
            ]);

            $created++;
        }

        return redirect()->route('usuarios.index')->with(
            'success',
            "Sincronización completada. Creados: {$created}. Actualizados: {$updated}. Omitidos: {$skipped}. (Contraseña inicial: password)"
        );
    }

    public function createFromTrabajador(Request $request, Trabajador $trabajador)
    {
        if (!$trabajador->email) {
            return redirect()->route('usuarios.index')->with('error', 'El trabajador no tiene email.');
        }

        $exists = User::query()->where('email', $trabajador->email)->exists();
        if ($exists) {
            return redirect()->route('usuarios.index')->with('info', 'Ya existe un usuario con ese email.');
        }

        User::create([
            'name' => trim($trabajador->nombre . ' ' . $trabajador->apellido),
            'email' => $trabajador->email,
            'password' => Hash::make('password'),
            'role' => 'usuario',
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado (rol usuario). Contraseña inicial: password');
    }

    public function updateRole(Request $request, User $user)
    {
        $authUser = $request->user();

        if ((int) $authUser->id === (int) $user->id) {
            return redirect()->route('usuarios.index')->with('error', 'No puedes cambiar tu propio rol.');
        }

        if ($user->isSuperAdmin()) {
            return redirect()->route('usuarios.index')->with('error', 'No se puede modificar el rol de un superadmin.');
        }

        $data = $request->validate([
            'role' => 'required|in:admin,usuario',
        ]);

        $user->role = $data['role'];
        $user->save();

        return redirect()->route('usuarios.index')->with('success', 'Rol actualizado correctamente.');
    }

    public function destroy(Request $request, User $user)
    {
        $authUser = $request->user();

        if ((int) $authUser->id === (int) $user->id) {
            return redirect()->route('usuarios.index')->with('error', 'No puedes borrarte a ti mismo.');
        }

        if (! $authUser->can('delete', $user)) {
            return redirect()->route('usuarios.index')->with('error', 'No tienes permisos para borrar este usuario.');
        }

        $user->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
