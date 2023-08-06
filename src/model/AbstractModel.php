<?php

declare(strict_types=1);

namespace App\model;
use App\Exception\ConfiguartionException;
use App\Exception\StorageException;
use PDO;
use PDOException;

abstract class AbstractModel
{
    protected PDO $conn;

    public function __construct(array $config) {
        try {
            $this->validateConfig($config);
            $this->createConnection($config);
        }
        catch(PDOException $a) {
            throw new StorageException('Connection error');
        }
    }

    private function createConnection(array $config): void {
        $dsn = 'mysql:dbname='.$config['database'].';host='.$config['host'];
        $this->conn = new PDO($dsn, $config['user'], $config['password'], [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]);
    }
    private function validateConfig(array $config): void {
        if(empty($config['database']) || empty($config['host']) || empty($config['user']) || empty($config['password'])) {
            throw new ConfiguartionException('NoteModel configuration error');
        }
    }
}