<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::create(__DIR__ . '/../');
$dotenv->load();

Collection::macro('toUpper', function () {
    return $this->map(function ($value) {
        return Str::upper($value);
    });
});
