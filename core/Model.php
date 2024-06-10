<?php

namespace Core;

use PDO;
use PDOException;
use App\Services\PaginateService;

class Model
{
    protected static $db;
    protected static $table;
    protected static $paginateService;

    public function __construct()
    {
        self::initDB();
    }

    protected static function initDB()
    {
        if (self::$db === null) {
            try {
                self::$db = new PDO(DB_SGBD . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
    }


    public static function paginate($resultados) {
        $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
        $resultado_por_pagina = $resultados;
        self::$paginateService = new PaginateService($resultado_por_pagina, $pagina);

        $allResults = self::all();
        self::$paginateService->setTotalResultados(count($allResults));

        $paginatedResults = self::getPaginated(self::$paginateService->getInicioResultado(), self::$paginateService->getResultadosPorPagina());

        return [
            'results' => $paginatedResults,
            'paginateService' => self::$paginateService
        ];
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

    public static function getPaginated($inicio, $limit)
    {
        self::initDB();

        $users = [];

        $stmt = self::$db->prepare("SELECT * FROM " . static::$table . " LIMIT $inicio, $limit");
        $stmt->execute();


        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetchAll()) {
                $users[] = $row;
            }
        }


        return $users;
    }
}
