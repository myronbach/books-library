<?php
spl_autoload_register(function($class){
    $file = ROOT . '/' . str_replace('\\', '/', $class). '.php';
    //echo $file;
    if (is_file($file)){
        require_once $file;
    }
});
