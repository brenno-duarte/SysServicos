<?php

spl_autoload_register(function($class) {
    include 'classes/' . $class . '.php';
});

abstract class SQL extends DB {
    
    protected $table;
    
    abstract public function insert();
    abstract public function update($id);

    public function find($id) {
        $sql = "SELECT * FROM $this->table WHERE id=:id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function findAll() {
        $sql = "SELECT * FROM $this->table";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE id=:id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

}