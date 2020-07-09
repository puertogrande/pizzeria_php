<?php

class Database {
    private static $pdo_db = 'mysql:host=localhost;dbname=pizzeria;charset=utf8';
    private static $pdo_user = 'root';
    private static $pdo_password = '';

    public function conectaDB() {
        try{
        $conexion = new PDO(self::$pdo_db, self::$pdo_user, self:: $pdo_password);
        $conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            echo ("Error de conexión: " . $e->getMessage());
        }
        return $conexion;

    }
}



?>