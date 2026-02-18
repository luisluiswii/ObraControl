<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$email = $argv[1] ?? null;
$newPassword = $argv[2] ?? null;

if (!$email || !$newPassword) {
    fwrite(STDERR, "Uso: php scripts/reset_user_password.php <email> <nueva_password>\n");
    exit(2);
}

$user = App\Models\User::query()->where('email', $email)->first();

if (!$user) {
    fwrite(STDERR, "No existe usuario con email: {$email}\n");
    exit(3);
}

$user->password = Illuminate\Support\Facades\Hash::make($newPassword);
$user->save();

echo "OK|{$user->id}|{$user->email}|{$user->role}\n";
