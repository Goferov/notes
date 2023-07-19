<?php

declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');
function dump($data) {
    echo '<pre>'.print_r($data, true).'</pre>';
}