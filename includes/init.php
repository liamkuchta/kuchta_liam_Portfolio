<?php
/**
 * App init file.
 * Handles class loading + env loading so each page doesnt repeat it.
 */

function loadEnvFile(string $envPath): void
{
    if (!file_exists($envPath)) {
        return;
    }

    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        $trimmedLine = trim($line);

        if ($trimmedLine === '' || strpos($trimmedLine, '#') === 0) {
            continue;
        }

        $separatorPos = strpos($trimmedLine, '=');
        if ($separatorPos === false) {
            continue;
        }

        $key = trim(substr($trimmedLine, 0, $separatorPos));
        $value = trim(substr($trimmedLine, $separatorPos + 1));

        if ($key === '') {
            continue;
        }

        if ((strpos($value, '"') === 0 && substr($value, -1) === '"') || (strpos($value, "'") === 0 && substr($value, -1) === "'")) {
            $value = substr($value, 1, -1);
        }

        putenv($key . '=' . $value);
        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
    }
}

// tiny autoloader for our Portfolio namespace
spl_autoload_register(function ($class) {
    // skip classes outside our app namespace
    if (strpos($class, 'Portfolio\\') !== 0) {
        return;
    }
    
    // remove Portfolio\\ part
    $class = str_replace('Portfolio\\', '', $class);
    
    // turn namespace slashes into folder slashes
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    
    // build full file path
    $filepath = __DIR__ . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . $class . '.php';
    
    if (file_exists($filepath)) {
        require_once $filepath;
    }
});

// if composer exists, use it (mainly for dotenv)
$composerAutoload = __DIR__ . '/vendor/autoload.php';
if (file_exists($composerAutoload)) {
    require_once $composerAutoload;
    
    // load .env values from project root
    $projectRoot = dirname(__DIR__);
    $dotenv = Dotenv\Dotenv::createImmutable($projectRoot);
    if (file_exists($projectRoot . '/.env')) {
        $dotenv->load();
    }
} else {
    // fallback loader when composer/dotenv is not installed
    loadEnvFile(dirname(__DIR__) . '/.env');
    loadEnvFile(__DIR__ . '/.env');
}
?>
