<?php

namespace Core;

use PDO;
use PDOException;

class Model
{
    protected static $db;
    protected static $table;

    public function __construct()
    {
        self::initDB();
    }

    protected static function initDB()
    {
        if (self::$db === null) {
            try {
                self::$db = new PDO(DB_SGBD. ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
    }

    public static function find($id)
    {
        self::initDB();
        $stmt = self::$db->prepare("SELECT * FROM " . static::$table . " WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function all()
    {
        self::initDB();
        $stmt = self::$db->prepare("SELECT * FROM " . static::$table);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
