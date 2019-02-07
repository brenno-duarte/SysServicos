<?php

spl_autoload_register(function($class) {
    include 'classes/' . $class . '.php';
});

class Clientes extends SQL {

    protected $table = 'tb_clientes';
    private $nome;
    private $cpf;
    private $fone;

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

    public function getFone() {
        return $this->fone;
    }

    public function setFone($fone) {
        $this->fone = $fone;
    }

    public function insert() {

        try {
            $sql = "INSERT INTO $this->table (nome,cpf,fone) VALUES (:nome,:cpf,:fone)";
            $stmt = DB::prepare($sql);
            $stmt->bindValue(':nome', $this->nome);
            $stmt->bindValue(':cpf', $this->cpf);
            $stmt->bindValue(':fone', $this->fone);
            return $stmt->execute();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function update($id) {

        try {
            $sql = "UPDATE $this->table SET nome = :nome,cpf = :cpf,fone = :fone WHERE id = :id";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':cpf', $this->cpf);
            $stmt->bindParam(':fone', $this->fone);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}

?>