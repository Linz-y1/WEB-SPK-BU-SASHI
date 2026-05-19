<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

$user = User::where('email', 'admin@example.com')->first();
if ($user) {
    echo "FOUND\n";
    echo "id: {$user->id}\n";
    echo "email: {$user->email}\n";
    echo "role: " . ($user->role ?? 'null') . "\n";
} else {
    echo "NOTFOUND\n";
}
