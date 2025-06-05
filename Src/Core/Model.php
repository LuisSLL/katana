<?php
namespace Src\Core;

use PDO;

abstract class Model
{
    protected PDO $db;
    protected string $table;
    protected static string $query;
    protected static array $bindings = [];

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public static function where($column, $value)
    {
        $instance = new static();
        self::$query = "SELECT * FROM {$instance->table} WHERE {$column} = :value LIMIT 1";
        self::$bindings = ['value' => $value];
        return $instance;
    }

    public static function first()
    {
        $instance = new static();
        $stmt = $instance->db->prepare(self::$query);
        $stmt->execute(self::$bindings);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? self::hydrate($data) : null;
    }

    protected static function hydrate(array $data)
    {
        $instance = new static();
        foreach ($data as $key => $value) {
            $instance->$key = $value;
        }
        return $instance;
    }

    public static function create(array $data)
    {
        $instance = new static();
        $db = $instance->db;

        $columns = implode(',', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $stmt = $db->prepare("INSERT INTO {$instance->table} ($columns) VALUES ($placeholders)");
        return $stmt->execute($data);
    }
}
