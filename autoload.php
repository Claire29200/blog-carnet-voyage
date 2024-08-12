<?php
declare(strict_types=1);

session_start();

spl_autoload_register(function ($className) {
    $className = ltrim($className, '\\');
    $lastNsPos = strrpos($className, '\\');
    if ($lastNsPos !== false) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        // Remplacer le namespace App par src
        $namespace = str_replace('App', 'src', $namespace);
        $namespace = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    } else {
        $namespace = 'src' . DIRECTORY_SEPARATOR;
    }

    $fileName = $namespace . $className . '.php';
    $fullPath = __DIR__ . DIRECTORY_SEPARATOR . $fileName;


    // Si le fichier existe, le charger
    if (file_exists($fullPath)) {
        require $fullPath;
        return true;

    } else {
        return false;
    }
});
