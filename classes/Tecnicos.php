<?php

spl_autoload_register(function($class) {
    include 'classes/' . $class . '.php';
});

class Tecnicos extends SQL {
    
    protected $table = 'tb_tecnicos';
    private $nome;
    private $cpf;
    
    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function insert() {

        try {
            $sql = "INSERT INTO $this->table (nome,cpf) VALUES (:nome,:cpf)";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':cpf', $this->cpf);
            return $stmt->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update($id) {

        try {
            $sql = "UPDATE $this->table SET nome = :nome,cpf = :cpf WHERE id=:id";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':cpf', $this->cpf);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}

?>