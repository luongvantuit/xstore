<?php

function auto_loader($className)
{
    // Define the base directory for your class files
    $baseDir = __DIR__ . "/src/";

    // Convert the namespace separators to directory separators
    $className = str_replace("\\", "/", $className);

    // Build the file path
    $filePath = $baseDir . $className . ".php";

    // Check if the file exists and include it
    if (file_exists($filePath)) {
        include_once $filePath;
    }
}

// Register the autoloader function
spl_autoload_register("auto_loader");
