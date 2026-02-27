<?php
/**
 * App init file.
 * Handles class loading + env loading so each page doesnt repeat it.
 */

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
    
    // load .env values
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    if (file_exists(__DIR__ . '/.env')) {
        $dotenv->load();
    }
}
?>
