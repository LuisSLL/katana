<?php
namespace Src\Core;

use PDO;
use Exception;

/**
 * Clase base para modelos tipo ORM.
 * Provee métodos CRUD y consultas básicas.
 */
abstract class Model
{
    /** @var PDO */
    protected PDO $db;
    /** @var string */
    protected string $table;
    /** @var array */
    protected array $attributes = [];

    public function __construct(array $attributes = [])
    {
        $this->db = Database::getInstance()->getConnection();
        $this->fill($attributes);
    }

    /**
     * Asigna atributos masivamente.
     */
    public function fill(array $attributes): void
    {
        foreach ($attributes as $key => $value) {
            $this->attributes[$key] = $value;
            $this->$key = $value;
        }
    }

    /**
     * Obtiene todos los registros.
     */
    public static function all(): array
    {
        $instance = new static();
        $stmt = $instance->db->query("SELECT * FROM {$instance->table}");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => new static($row), $results);
    }

    /**
     * Busca por ID.
     */
    public static function find($id): ?self
    {
        $instance = new static();
        $stmt = $instance->db->prepare("SELECT * FROM {$instance->table} WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new static($data) : null;
    }

    /**
     * Consulta por columna y valor (devuelve array de instancias).
     */
    public static function where($column, $value): array
    {
        $instance = new static();
        $stmt = $instance->db->prepare("SELECT * FROM {$instance->table} WHERE {$column} = :value");
        $stmt->execute(['value' => $value]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => new static($row), $results);
    }

    /**
     * Devuelve el primer resultado de una consulta where.
     */
    public static function firstWhere($column, $value): ?self
    {
        $results = static::where($column, $value);
        return $results[0] ?? null;
    }

    /**
     * Crea un nuevo registro y retorna la instancia.
     */
    public static function create(array $data): ?self
    {
        $instance = new static();
        $columns = implode(',', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $stmt = $instance->db->prepare("INSERT INTO {$instance->table} ($columns) VALUES ($placeholders)");
        if ($stmt->execute($data)) {
            $id = $instance->db->lastInsertId();
            return static::find($id);
        }
        return null;
    }

    /**
     * Actualiza el registro actual.
     */
    public function update(array $data): bool
    {
        $sets = [];
        foreach ($data as $key => $value) {
            $sets[] = "$key = :$key";
        }
        $sql = "UPDATE {$this->table} SET " . implode(',', $sets) . " WHERE id = :id";
        $data['id'] = $this->attributes['id'] ?? $this->id;
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute($data);
        if ($result) {
            $this->fill($data);
        }
        return $result;
    }

    /**
     * Elimina el registro actual.
     */
    public function delete(): bool
    {
        $id = $this->attributes['id'] ?? $this->id;
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Relación hasMany (uno a muchos).
     */
    public function hasMany(string $related, string $foreignKey, string $localKey = 'id'): array
    {
        $localValue = $this->attributes[$localKey] ?? $this->$localKey;
        return $related::where($foreignKey, $localValue);
    }

    /**
     * Relación belongsTo (muchos a uno).
     */
    public function belongsTo(string $related, string $foreignKey, string $ownerKey = 'id'): ?self
    {
        $foreignValue = $this->attributes[$foreignKey] ?? $this->$foreignKey;
        return $related::find($foreignValue);
    }

    /**
     * Acceso a atributos dinámicos.
     */
    public function __get($name)
    {
        return $this->attributes[$name] ?? null;
    }

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
        $this->$name = $value;
    }
}
