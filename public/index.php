<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Permet de servir l'app depuis un sous-dossier (ex. htdocs XAMPP)
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
$siteDir = dirname($scriptDir);
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
if ($scriptDir !== '/' && $siteDir !== $scriptDir
    && str_starts_with($requestUri, $siteDir)
    && !str_starts_with($requestUri, $scriptDir . '/')
    && $requestUri !== $scriptDir
) {
    $_SERVER['REQUEST_URI'] = $scriptDir . substr($requestUri, strlen($siteDir));
}

// Static maintenance toggle (works even if Laravel cannot boot)
if (file_exists(__DIR__ . '/.maintenance')) {
    require __DIR__ . '/maintenance.php';
    exit;
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
