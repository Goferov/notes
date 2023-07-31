<?php

declare(strict_types=1);

namespace App;

require_once "exception/StorageException.php";

use App\Exception\ConfiguartionException;
use App\Exception\StorageException;
use PDO;
use PDOException;
class Database
{
    public function __construct(array $config) {
        try {

            if(empty($config['database']) || empty($config['host']) || empty($config['user']) || $config['password']) {
                throw new ConfiguartionException('Database configuration error');
            }

            $dsn = 'mysql:dbname='.$config['database'].';host='.$config['host'];
//            $connection = new PDO($dsn,$config['user'],$config['password']);
            $connection = new PDO('sss');
        }
        catch(PDOException $a) {
            throw new StorageException('Connection error');
        }

    }
}