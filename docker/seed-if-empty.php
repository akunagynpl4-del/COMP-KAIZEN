<?php

use App\Models\Product;
use Illuminate\Contracts\Console\Kernel;

require dirname(__DIR__) . '/vendor/autoload.php';

$app = require dirname(__DIR__) . '/bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

if (Product::query()->doesntExist()) {
    $kernel->call('db:seed', ['--force' => true]);
} else {
    $kernel->call('db:seed', [
        '--class' => Database\Seeders\AdminUserSeeder::class,
        '--force' => true,
    ]);
}

echo $kernel->output();