<?php

declare(strict_types=1);

namespace App;

require_once "exception/StorageException.php";
require_once "exception/NotFoundException.php";

use App\Exception\ConfiguartionException;
use App\Exception\NotFoundException;
use App\Exception\StorageException;
use PDO;
use PDOException;
use Throwable;
class Database
{

    private PDO $conn;

    public function __construct(array $config) {
        try {
            $this->validateConfig($config);
            $this->createConnection($config);

        }
        catch(PDOException $a) {
            throw new StorageException('Connection error');
        }
    }

    public function createNote(array $data): void {
        try {

            $title = $this->conn->quote($data['title']);
            $description = $this->conn->quote($data['description']);
            $created = date("Y-m-d H:i:s");

            $query = "INSERT INTO notes (title, description, created) VALUES($title, $description, '$created');";
            $this->conn->exec($query);
        }
        catch(Throwable $e) {
            throw new StorageException('Error creating note',400, $e);
        }
    }

    public function getNotes() : array {
        try {
            $query = "SELECT id, title, created FROM notes";
            $result = $this->conn->query($query);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (Throwable $e) {
            throw new StorageException('Error while downloading notes',400, $e);
        }
    }

    public function getNote(int $id) : array {
        try {
            $query = "SELECT * FROM notes WHERE id = $id";
            $result = $this->conn->query($query);
            $note = $result->fetch(PDO::FETCH_ASSOC);
        }
        catch (Throwable $e) {
            throw new StorageException('Error while getting note ', 400, $e);
        }

        if(!$note) {
            throw new NotFoundException('Note not found');
        }

        return $note;
    }

    private function createConnection(array $config): void {
        $dsn = 'mysql:dbname='.$config['database'].';host='.$config['host'];
        $this->conn = new PDO($dsn, $config['user'], $config['password'], [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]);
    }
    private function validateConfig(array $config): void {
        if(empty($config['database']) || empty($config['host']) || empty($config['user']) || empty($config['password'])) {
            throw new ConfiguartionException('Database configuration error');
        }
    }
}