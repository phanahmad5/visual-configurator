<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$designs = App\Models\Design::latest()->take(3)->get();
foreach ($designs as $d) {
    echo "ID: " . $d->id . PHP_EOL;
    echo "Name: " . $d->name . PHP_EOL;
    echo "Export Image: " . ($d->export_image ?? 'NULL') . PHP_EOL;
    echo "Product Type: " . ($d->product_type ?? 'NULL') . PHP_EOL;
    echo "Shirt Color: " . ($d->shirt_color ?? 'NULL') . PHP_EOL;
    echo "---" . PHP_EOL;
}
