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
            $this->validateConfig($config);
            $dsn = 'mysql:dbname='.$config['database'].';host='.$config['host'];
            $connection = new PDO($dsn,$config['user'],$config['password']);
        }
        catch(PDOException $a) {
            throw new StorageException('Connection error');
        }

    }

    private function validateConfig(array $config): void {
        if(empty($config['database']) || empty($config['host']) || empty($config['user']) || empty($config['password'])) {
            throw new ConfiguartionException('Database configuration error');
        }
    }
}