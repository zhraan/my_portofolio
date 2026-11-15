<?php

/**
 * Static export for Netlify.
 *
 * Netlify can't run PHP at request time, so this script boots Laravel during
 * the build, loads the portfolio content from the seeders into a throwaway
 * in-memory SQLite database, renders the public homepage to dist/index.html,
 * and copies the public assets (images, Vite build output) next to it.
 *
 * Run after `vite build`:  php scripts/build-static.php
 */

$root = dirname(__DIR__);
$dist = $root . '/dist';

// Build-time environment: no .env, no persistent DB, no sessions.
$env = [
    'APP_ENV'        => 'production',
    'APP_DEBUG'      => 'false',
    'APP_URL'        => 'http://localhost',
    'APP_KEY'        => 'base64:' . base64_encode(random_bytes(32)),
    'DB_CONNECTION'  => 'sqlite',
    'DB_DATABASE'    => ':memory:',
    'CACHE_STORE'    => 'array',
    'SESSION_DRIVER' => 'array',
    'QUEUE_CONNECTION' => 'sync',
    'LOG_CHANNEL'    => 'stderr',
];
foreach ($env as $key => $value) {
    putenv("$key=$value");
    $_ENV[$key] = $_SERVER[$key] = $value;
}

require $root . '/vendor/autoload.php';
$app = require $root . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

function run_artisan(string $command, array $params = []): void
{
    $code = Artisan::call($command, $params + ['--force' => true]);
    if ($code !== 0) {
        fwrite(STDERR, Artisan::output());
        throw new RuntimeException("artisan $command failed");
    }
}

run_artisan('migrate');
// Order matters: CareerEntrySeeder truncates the placeholder career entries
// from ContentSeeder and replaces them with the real ones.
foreach (['DatabaseSeeder', 'ContentSeeder', 'CareerEntrySeeder', 'PortfolioSeeder'] as $seeder) {
    run_artisan('db:seed', ['--class' => "Database\\Seeders\\$seeder"]);
}

$html = app(App\Http\Controllers\HomeController::class)->index()->render();

// Make asset URLs root-relative so the page works on any domain / deploy preview.
$html = str_replace('http://localhost/', '/', $html);

File::deleteDirectory($dist);
File::copyDirectory($root . '/public', $dist);
File::delete([$dist . '/index.php', $dist . '/.htaccess', $dist . '/hot']);
File::put($dist . '/index.html', $html);

echo "Static site written to dist/index.html\n";
