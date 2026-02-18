<?php

namespace App\Services;

use App\Models\Trabajador;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TrabajadorUserSyncService
{
    /**
     * Vincula un trabajador con un usuario.
     * - Si existe usuario con el mismo email, lo vincula.
     * - Si no existe, lo crea con rol 'usuario' y obliga a cambiar contraseña al primer login.
     *
     * @return array{linked: bool, created: bool, password?: string}
     */
    public function ensureUserForTrabajador(Trabajador $trabajador): array
    {
        $email = trim((string) $trabajador->email);

        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['linked' => false, 'created' => false];
        }

        // Ya vinculado
        if ($trabajador->user_id) {
            return ['linked' => true, 'created' => false];
        }

        $existing = User::query()->where('email', $email)->first();
        if ($existing) {
            // Si ese usuario ya está asignado a otro trabajador, no forzamos.
            $alreadyLinked = Trabajador::query()->where('user_id', $existing->id)->exists();
            if ($alreadyLinked) {
                return ['linked' => false, 'created' => false];
            }

            $trabajador->user_id = $existing->id;
            $trabajador->save();

            // Normaliza rol vacío
            if (!$existing->role) {
                $existing->role = 'usuario';
                $existing->save();
            }

            return ['linked' => true, 'created' => false];
        }

        $plainPassword = Str::password(12);

        $user = User::create([
            'name' => trim($trabajador->nombre . ' ' . $trabajador->apellido) ?: $email,
            'email' => $email,
            'password' => Hash::make($plainPassword),
            'must_change_password' => true,
            'role' => 'usuario',
            'remember_token' => Str::random(10),
        ]);

        $trabajador->user_id = $user->id;
        $trabajador->save();

        return ['linked' => true, 'created' => true, 'password' => $plainPassword];
    }

    /**
     * Si el trabajador está vinculado a un usuario, sincroniza su email.
     */
    public function syncUserEmailFromTrabajador(Trabajador $trabajador): bool
    {
        if (!$trabajador->user_id) {
            return false;
        }

        $email = trim((string) $trabajador->email);
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $user = User::query()->find($trabajador->user_id);
        if (!$user) {
            return false;
        }

        if ($user->email === $email) {
            return true;
        }

        $emailInUse = User::query()->where('email', $email)->where('id', '!=', $user->id)->exists();
        if ($emailInUse) {
            return false;
        }

        $user->email = $email;
        $user->save();

        return true;
    }
}
