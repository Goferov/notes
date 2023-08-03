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
use App\exception\AppException;
use App\exception\ConfiguartionException;

$request = new Request($_GET, $_POST);


try {
    NoteController::initConfiguration($configuration);
    (new NoteController($request))->run();
}
catch(ConfiguartionException $e) {
    echo '<h3>'.$e->getMessage().'</h3>';
}
catch(AppException $e) {
    echo '<h3>'.$e->getMessage().'</h3>';
}
catch(Throwable $e) {
    dump($e);
    echo '<h3>App error</h3>';
}





