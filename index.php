<?php
declare(strict_types=1);

namespace App;
use App\Exception\AppException;
use App\Exception\ConfiguartionException;
use Throwable;

$configuration = require_once "config/config.php";
require_once "src/utils/debug.php";
require_once "src/Controller.php";
require_once "src/exception/AppException.php";


try {
    $request = [
        'get'=>$_GET,
        'post'=>$_POST
    ];
    Controller::initConfiguration($configuration);
    (new Controller($request))->run();
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





