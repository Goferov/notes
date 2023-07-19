<?php
declare(strict_types=1);

namespace App;

require_once("src/utils/debug.php");

$action = htmlentities($_GET['action'] ?? '');



include_once('templates/pages/list.php');