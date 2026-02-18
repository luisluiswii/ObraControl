<?php

declare(strict_types=1);

use App\Models\User;

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$email = $argv[1] ?? null;
$role = $argv[2] ?? null;
$mustChangePassword = $argv[3] ?? null;

if (!$email || !$role) {
    fwrite(STDERR, "Uso: php scripts/set_user_role_and_flags.php <email> <role> [must_change_password 0|1]\n");
    exit(1);
}

/** @var User|null $user */
$user = User::query()->where('email', $email)->first();

if (!$user) {
    fwrite(STDERR, "No existe el usuario con email: {$email}\n");
    exit(2);
}

$user->role = $role;
if ($mustChangePassword !== null) {
    $user->must_change_password = (bool) ((int) $mustChangePassword);
}
$user->save();

echo "OK|{$user->id}|{$user->email}|role={$user->role}|must_change_password=" . ((int) $user->must_change_password) . "\n";
