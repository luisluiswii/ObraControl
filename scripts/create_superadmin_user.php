<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Hash;

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$email = $argv[1] ?? null;
$password = $argv[2] ?? null;
$name = $argv[3] ?? 'Super Admin';

if (!$email || !$password) {
    fwrite(STDERR, "Uso: php scripts/create_superadmin_user.php <email> <password> [name]\n");
    exit(1);
}

/** @var User $user */
$user = User::query()->firstOrNew(['email' => $email]);

$user->name = $name;
$user->role = 'superadmin';
$user->must_change_password = false;
$user->password = Hash::make($password);
$user->save();

echo "OK|{$user->id}|{$user->email}|role={$user->role}|must_change_password=" . ((int) $user->must_change_password) . "\n";
