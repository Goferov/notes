<?php
declare(strict_types=1);

namespace App;

$configuration = require_once "config/config.php";
require_once "src/utils/debug.php";
require_once "src/Controller.php";


$request = [
  'get'=>$_GET,
  'post'=>$_POST
];
Controller::initConfiguration($configuration);
(new Controller($request))->run();



