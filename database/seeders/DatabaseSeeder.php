<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Trabajador;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // --- Cuentas demo para el profesor (3 roles) ---

        $createOrUpdateUser = function (string $email, string $name, string $role, string $plainPassword): User {
            /** @var User $user */
            $user = User::query()->firstOrNew(['email' => $email]);
            $user->name = $name;
            $user->role = $role;
            $user->must_change_password = false;
            $user->password = Hash::make($plainPassword);
            $user->save();
            return $user;
        };

        $superadmin = $createOrUpdateUser('superadmin.cleartime@gmail.com', 'Super Admin', 'superadmin', 'SuperAdmin1234!');
        $admin = $createOrUpdateUser('admin@example.com', 'Admin', 'admin', 'Admin1234!');
        $usuario = $createOrUpdateUser('test@example.com', 'Test User', 'usuario', 'Usuario1234!');

        // Asociar el usuario normal a un trabajador (para poder usar Mi Panel)
        $existingTrabajador = Trabajador::withTrashed()->where('user_id', $usuario->id)->first();
        if (! $existingTrabajador) {
            $dni = 'TEST-' . str_pad((string) $usuario->id, 4, '0', STR_PAD_LEFT);
            if (Trabajador::withTrashed()->where('dni', $dni)->exists()) {
                $dni = $dni . '-' . bin2hex(random_bytes(2));
            }

            Trabajador::create([
                'user_id' => $usuario->id,
                'nombre' => 'Test',
                'apellido' => 'User',
                'dni' => $dni,
                'telefono' => null,
                'email' => $usuario->email,
                'puesto' => 'Operario',
                'salario_hora' => 10.00,
                'foto' => null,
            ]);
        }

        $faker = \Faker\Factory::create('es_ES');

        $trabajadorIds = [];
        for ($i = 0; $i < 8; $i++) {
            $trabajadorIds[] = DB::table('trabajadores')->insertGetId([
                'nombre' => $faker->firstName,
                'apellido' => $faker->lastName,
                'dni' => $faker->unique()->bothify('########?'),
                'telefono' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'puesto' => $faker->randomElement(['Albañil', 'Encargado', 'Carpintero', 'Electricista']),
                'salario_hora' => $faker->randomFloat(2, 12, 35),
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $obraIds = [];
        for ($i = 0; $i < 4; $i++) {
            $obraIds[] = DB::table('obras')->insertGetId([
                'nombre' => 'Obra ' . Str::title($faker->words(2, true)),
                'direccion' => $faker->streetAddress,
                'fecha_inicio' => $faker->dateTimeBetween('-6 months', '-1 month')->format('Y-m-d'),
                'fecha_fin' => null,
                'estado' => $faker->randomElement(['en curso', 'pausada', 'finalizada']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $asignaciones = [];
        foreach ($trabajadorIds as $trabajadorId) {
            $obrasAsignadas = $faker->randomElements($obraIds, $faker->numberBetween(1, 2));
            foreach ($obrasAsignadas as $obraId) {
                $key = $trabajadorId . '-' . $obraId;
                if (isset($asignaciones[$key])) {
                    continue;
                }

                $asignaciones[$key] = true;

                DB::table('obra_trabajador')->insert([
                    'obra_id' => $obraId,
                    'trabajador_id' => $trabajadorId,
                    'fecha_asignacion' => $faker->dateTimeBetween('-2 months', '-1 week')->format('Y-m-d'),
                    'fecha_fin' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        foreach ($trabajadorIds as $trabajadorId) {
            $obraId = $faker->randomElement($obraIds);
            $dias = $faker->numberBetween(3, 6);

            for ($d = 0; $d < $dias; $d++) {
                $fecha = Carbon::now()->subDays($d)->toDateString();
                $horaEntrada = Carbon::parse($fecha . ' ' . $faker->time('H:i:s', '09:00:00'));
                $horaSalida = (clone $horaEntrada)->addHours($faker->numberBetween(6, 9));

                DB::table('fichajes')->insert([
                    'trabajador_id' => $trabajadorId,
                    'obra_id' => $obraId,
                    'fecha' => $fecha,
                    'hora_entrada' => $horaEntrada->format('H:i:s'),
                    'hora_salida' => $horaSalida->format('H:i:s'),
                    'horas_trabajadas' => round($horaEntrada->diffInMinutes($horaSalida) / 60, 2),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
