<?php
declare(strict_types=1);

spl_autoload_register(function(string  $classNamespace) {
    $classNamespace = str_replace(['\\','App/'],['/',''],$classNamespace);
    $path = 'src/' . $classNamespace . '.php';
    require_once $path;
});

require_once "src/utils/debug.php";
$configuration = require_once "config/config.php";

use App\Request;
use App\controller\NoteController;
use App\exception\ConfiguartionException;

$request = new Request($_GET, $_POST, $_SERVER);

try {
    NoteController::initConfiguration($configuration);
    (new NoteController($request))->run();
}
catch(ConfiguartionException $e) {
    echo '<h1>App error</h1>';
    echo '<h3>'.$e->getMessage().'</h3>';
}
catch(Throwable $e) {
    echo '<h3>App error</h3>';
    echo '<h3>'.$e->getMessage().'</h3>';
}





