<?php

session_start();

spl_autoload_register('autoloader');

function autoloader($className) 
{   
    $className = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $className);

    $classFile = __DIR__.DIRECTORY_SEPARATOR.$className.'.php';

 

    if (file_exists($classFile)) {
        include $classFile;
    } else {
      

      Core\Route::ErrorPage404();
    }
}

use Core\Route;

Route::start();