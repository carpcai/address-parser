<?php


/**
 * Created by PhpStorm.
 * User: Carp Cai
 * Date: 2018/12/1
 * Time: 11:27 PM
 */
function loadClass($class) {
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $path = str_replace('countries' . DIRECTORY_SEPARATOR, '', $path);
    $path = str_replace('CarpCai/AddressParser' . DIRECTORY_SEPARATOR, '', $path);

    $file = __DIR__ . '/' . $path . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
}
spl_autoload_register('loadClass'); // Registers the autoloader