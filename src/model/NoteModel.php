<?php

declare(strict_types=1);

namespace App\model;

use App\Exception\NotFoundException;
use App\Exception\StorageException;
use PDO;
use Throwable;

class NoteModel extends AbstractModel implements ModelInterface
{
    public function create(array $data): void {
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

    public function list(int $pageNumber, int $pageSize, string $sortBy, string $sortOrder) : array {
        return $this->findBy(null, $pageNumber, $pageSize, $sortBy, $sortOrder);
    }


    public function search(string $phrase, int $pageNumber, int $pageSize, string $sortBy, string $sortOrder): array {
        return $this->findBy($phrase, $pageNumber, $pageSize, $sortBy, $sortOrder);
    }

    public function searchCount(string $phrase): int {
        try {
            $phrase = $this->conn->quote('%'.$phrase.'%');
            $query = "SELECT COUNT(*) AS noteCount FROM notes WhERE title LIKE($phrase)";
            $result = $this->conn->query($query);
            $result = $result->fetch(PDO::FETCH_ASSOC);
            return $result['noteCount'];
        }
        catch (Throwable $e) {
            throw new StorageException('Number of notes error',400, $e);
        }
    }

    public function count(): int {
        try {
            $query = "SELECT COUNT(*) AS noteCount FROM notes";
            $result = $this->conn->query($query);
            $result = $result->fetch(PDO::FETCH_ASSOC);
            return $result['noteCount'];
        }
        catch (Throwable $e) {
            throw new StorageException('Number of notes error',400, $e);
        }
    }


    public function get(int $id) : array {
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

    public function edit(int $id, array $data): void {
        try {
            $title = $this->conn->quote($data['title']);
            $description = $this->conn->quote($data['description']);
            $query = "UPDATE notes SET title = $title, description = $description WHERE id = $id";
            $this->conn->exec($query);
        }
        catch (Throwable $e) {
            throw new StorageException('Note update error', 400, $e);
        }
    }

    public function delete(int $id): void {
        try {
            $query = "DELETE FROM notes WHERE id = $id";
            $this->conn->exec($query);
        }
        catch (Throwable $e) {
            throw new StorageException('Note delete error', 404, $e);
        }
    }

    private function findBy(?string $phrase, int $pageNumber, int $pageSize, string $sortBy, string $sortOrder): array {
        try {
            $offset = ($pageNumber - 1) * $pageSize;
            if(!in_array($sortBy, ['created','title'])) {
                $sortBy = 'title';
            }

            if(!in_array($sortOrder, ['asc','desc'])) {
                $sortOrder = 'asc';
            }

            $where = '';
            if($phrase) {
                $phrase = $this->conn->quote('%'.$phrase.'%');
                $where = 'WHERE title LIKE('.$phrase.')';
            }

            $query = "SELECT id, title, created FROM notes $where ORDER BY $sortBy $sortOrder LIMIT $offset, $pageSize";
            $result = $this->conn->query($query);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (Throwable $e) {
            throw new StorageException('Error searching notes notes',400, $e);
        }
    }
 }