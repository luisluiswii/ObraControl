<?php

declare(strict_types=1);

use App\Models\Trabajador;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

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
        if (!$user->role) {
            $user->role = 'usuario';
            $user->save();
            $updated++;
        }

        if (!$t->user_id) {
            $t->user_id = $user->id;
            $t->save();
        }
        continue;
    }

    User::create([
        'name' => $name,
        'email' => $email,
        'password' => Hash::make('password'),
        'must_change_password' => true,
        'role' => 'usuario',
        'remember_token' => Str::random(10),
    ]);

    $t->user_id = User::query()->where('email', $email)->value('id');
    $t->save();

    $created++;
}

echo "OK created={$created} updated={$updated} skipped={$skipped}\n";
echo "Default password for created users: password\n";
