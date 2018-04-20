<?php 

// function __autoload($class) {

//     $class = strtolower($class);
//     $path = "includes/{$class}.php";

//     if (file_exists($path)) {
//         require_once($path);
//     } else {
//         die("This file name {$class}.php was not found");
//     }
// }

function classAutoloader($class) {

    $class = strtolower($class);
    $path = "includes/{$class}.php";


    if(is_file($path) && !class_exists($class)) {
        include $path;
    }
    // if (file_exists($path)) {
    //     require_once($path);
    // } else {
    //     die("This file name {$class}.php was not found");
    // }
}

spl_autoload_register('classAutoLoader');





?>