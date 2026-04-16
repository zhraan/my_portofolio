<?php
require __DIR__."/vendor/autoload.php";
$app = require_once __DIR__."/bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$entries = App\Models\CareerEntry::all();
foreach($entries as $e) {
    echo "ID: $e->id, Position: $e->position\n";
    echo "Desc: " . implode(" ", $e->description ?? []) . "\n\n";
}
