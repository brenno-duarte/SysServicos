<?php

spl_autoload_register(function($class){
	include 'classes/' . $class . '.php';
});

class SQL extends DB {

	public static function prepare($sql) {
		return $stmt = DB::Conectar()->prepare($sql);
	}

	public function find($id) {
		$sql = "SELECT * FROM $this->table WHERE id=:id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		return $stmt->fetch();
	}

	public function findAll() {
		$sql = "SELECT * FROM $this->table";
		$stmt = DB::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function delete($id) {
		$sql = "DELETE FROM $this->table WHERE id=:id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id', $id);
		return $stmt->execute();
	}
}

?>