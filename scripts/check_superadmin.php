<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$superAdmins = App\Models\User::query()
    ->where('role', 'superadmin')
    ->orderBy('id')
    ->get(['id', 'name', 'email', 'role']);

foreach ($superAdmins as $user) {
    echo $user->id . '|' . $user->name . '|' . $user->email . '|' . $user->role . PHP_EOL;
}
