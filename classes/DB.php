<?php

require_once("Config.php");

class DB {

    private static $con;

    public static function Conectar() {

        if (!isset(self::$con)) {
            try {
                self::$con = new PDO(DB_DRIVE . ":host=" . DB_HOST . ";dbname=" . DB_DATABASE, DB_USER, DB_PASSWORD);
                self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return self::$con;
            } catch (PDOException $e) {
                echo "<h3 style='color:red;'>Erro no banco: </h3>" . $e->getMessage();
                die();
            }
        }

        return self::$con;
    }

    public static function prepare($sql) {
        return $stmt = DB::Conectar()->prepare($sql);
    }

    public static function query($sql) {
        return $stmt = DB::Conectar()->query($sql);
    }

}

?>