<?php

declare(strict_types=1);

use App\Models\Trabajador;
use App\Models\User;

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$linked = 0;
$skipped = 0;

$trabajadores = Trabajador::query()
    ->whereNull('user_id')
    ->whereNotNull('email')
    ->where('email', '<>', '')
    ->orderBy('id')
    ->get();

foreach ($trabajadores as $t) {
    $email = trim((string) $t->email);
    $u = User::query()->where('email', $email)->first();

    if (!$u) {
        $skipped++;
        continue;
    }

    $alreadyLinked = Trabajador::query()->where('user_id', $u->id)->exists();
    if ($alreadyLinked) {
        $skipped++;
        continue;
    }

    $t->user_id = $u->id;
    $t->save();
    $linked++;
}

echo "OK linked={$linked} skipped={$skipped}\n";
