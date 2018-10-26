<?php
//use app\core\Application AS Application;
//ini_set( "display_errors", true );


/*define('ROOT', dirname(__DIR__).DIRECTORY_SEPARATOR);
define('APP',ROOT .'app'.DIRECTORY_SEPARATOR);
define('VIEW',ROOT.'app'.DIRECTORY_SEPARATOR . 'view' .DIRECTORY_SEPARATOR);
define('MODEL',ROOT.'app'.DIRECTORY_SEPARATOR . 'model' .DIRECTORY_SEPARATOR);
define('CONTROLLER',ROOT.'app'.DIRECTORY_SEPARATOR . 'controllers' .DIRECTORY_SEPARATOR);
define('CORE',ROOT.'app'.DIRECTORY_SEPARATOR . 'core' .DIRECTORY_SEPARATOR);
$modules=[ROOT,APP,CORE,CONTROLLER];*/
/*
//set_include_path(get_include_path() . PATH_SEPARATOR . 'app/core/Application.php');
set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR, $modules));
spl_autoload_register('spl_autoload', false);
//var_dump(get_include_path());
//var_dump(implode(PATH_SEPARATOR, $modules));


spl_autoload_register(function($class){
    $file=str_replace('\\', '//', $class);
    require $file.'.php';
});*/
function application_autoloader($class) {
    $class = strtolower($class);
    $class_filename = strtolower($class).'.php';
    $class_root = dirname(__FILE__);
    $cache_file = "{$class_root}/cache/classpaths.cache";
    $path_cache = (file_exists($cache_file)) ? unserialize(file_get_contents($cache_file)) : array();
    if (!is_array($path_cache)) { $path_cache = array(); }

    if (array_key_exists($class, $path_cache)) {
        /* Load class using path from cache file (if the file still exists) */
        if (file_exists($path_cache[$class])) { require_once $path_cache[$class]; }

    } else {
        /* Determine the location of the file within the $class_root and, if found, load and cache it */
        $directories = new RecursiveDirectoryIterator($class_root);
        foreach(new RecursiveIteratorIterator($directories) as $file) {
            if (strtolower($file->getFilename()) == $class_filename) {
                $full_path = $file->getRealPath();
                $path_cache[$class] = $full_path;
                require_once $full_path;
                break;
            }
        }

    }

    $serialized_paths = serialize($path_cache);
    if ($serialized_paths != $path_cache) { file_put_contents($cache_file, $serialized_paths); }
}

spl_autoload_register('application_autoloader');


$app= new application;
?>
